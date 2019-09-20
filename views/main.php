<!-- Вьюха отчета -->
<h1>Сводный отчет</h1>

<form method="post" id="period" class="row mt-3">
	<?php if($period){ ?>
		<select name="period" class="form-control ml-3 mt-1 col-xl-2 col-lg-4 col-md-6 col-sm-10" required>
			<option value="" disabled selected>Выберите период</option>
			<?php foreach($period as $d){ ?>
				<option value="<?=$d['year']?>-<?=$d['month']?>"><?= $rus[$d['month']] ?> <?=$d['year']?></option>
			<?php } ?>
		</select>
	<?php } ?>
	<select name="type" class="form-control ml-3 mt-1 col-xl-2 col-lg-4 col-md-6 col-sm-10">
		<option value="" selected>Выберите тип клиента</option>
		<option value="0">физ. лицо</option>
		<option value="1">юр. лицо</option>
	</select>
	<button class="btn btn-primary ml-3 mt-1">Смотреть</button>
</form>


<table class="table table-striped w-100 mt-5 d-none" id="report">
	<thead>
		<tr>
			<th><?= implode('</th><th>',['Услуга','Баланс на начало периода','Приход','Расход','Перерасчет','Итого']); ?></th>
		</tr>
	</thead>
	<tbody id="list">
	</tbody>
</table>
