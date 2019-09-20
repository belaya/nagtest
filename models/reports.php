<?php
//Класс модели сводного отчета
class Reports
{
	//месяцы в именительном падеже
	public $mounts = [1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь'];

	//функция получает месяцы и годы из БД (исключаем "лишние" поля для для формы)
	public function viewReport()
	{
		$sql = "SELECT YEAR(`DATA`) as `year`, MONTH(`DATA`) as `month` FROM `payment` GROUP BY `year`,`month` ORDER BY `DATA`";
		return ['period' => DB::prepare($sql)->execute()->fetchAll(), 'rus' => $this->mounts];
	}

	//функция обработки ajax запроса и полученния даннных из БД
	public function dataReport($params)
	{
		//пустую форму не принимаем
		if (!isset($params) || empty($params)) 
		return Route::ErrorPage404(); 

		$data = [];
		$where = [];
		$and = "";

		foreach ($params as $key => $value) {
			if (strlen($value) === 0) continue;
			if ($key == 'period'){
				$mount = strtotime($value."-01");
				$data[':'.$key.'1'] = (string) date("Y-m-d", $mount);
				$data[':'.$key.'2'] = (string) date("Y-m-t",$mount);
			}else{
				$data[':'.$key] = (int) $value;
			}
		}

		//не уверена на счет правильной оптимизации запроса (давно не работала с большими обьемами в MySQL)
		$sql = "
			SELECT 
				s.`NAME` as `typename`,
				SUM(IF(p.`DATA` < :period1,p.`SUMMA`,0)) as `balans`,
				SUM(IF(p.`DATA` <= :period2,p.`SUMMA`,0)) as `itog`,
				SUM(IF(t1.`SUMMA` > 0,t1.`SUMMA`,0)) as `incom`,
				SUM(IF(t1.`SUMMA` < 0,t1.`SUMMA`,0)) as `cost`,
				SUM(IF(t1.`PAY_ID` = 3,t1.`SUMMA`,0)) as `recalc`
		 	FROM 
		 		`services` as s
 			LEFT JOIN `payment` as p ON `p`.`ACNT_ID` = `s`.`ID`
 			LEFT JOIN (SELECT `ID`, `SUMMA`, `PAY_ID` FROM `payment` WHERE `DATA` BETWEEN :period1 AND :period2) as `t1` ON `t1`.`ID` = `p`.`ID`
  		";

  		//если указан тип клиента
		if (strlen($params['type']) !== 0){
			$sql.= " LEFT JOIN `clients` as `c` ON `c`.`ID` = `p`.`CLIENT_ID`";
			$where[] = '`c`.`TYPE` = :type';
		}

		if (sizeof($where) > 0)
			$sql.= " WHERE ".implode(" AND ",$where);

		//группируем по услугам
		$sql.= " GROUP BY `s`.`ID`";

		return DB::prepare($sql)->execute($data)->fetchAll();;
	}

}