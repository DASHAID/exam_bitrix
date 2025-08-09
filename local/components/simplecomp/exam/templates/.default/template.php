<?php if (empty($arResult["CLASSIFIERS"])): ?>
	<p> claasificatory ne naydeni</p>
<?php else : ?>
	<div class="classifiers-list">
		<?php foreach ($arResult["CLASSIFIERS"] as $classifier): ?>
			<h2><?=htmlspecialcharsbx($classifier["NAME"])?></h2>
			<?php if (empty($classifier["ITEMS"])): ?>
				<p> TOVARI NE NAYDENI</p>
			<?php else: ?>
				<ul>
				<?php foreach ($classifier["ITEMS"] as $item):?>
					<li>
						<a href="<?=htmlspecialcharsbx($item[DETAIL_PAGE_URL"])?>"><?=htmlspecialcharsbx($item["NAME"])?></a>
						CENA: <?=htmlspecialcharsbx($item["PRICE"])?>,
						MATERIAL: <?=htmlspecialcharsbx($item["MATERIAL"])?>,
						ARTICUL: <?=htmlspecialcharsbx($item["ARTIKUL"])?>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif;?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
