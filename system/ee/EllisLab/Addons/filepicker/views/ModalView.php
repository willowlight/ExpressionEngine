<div class="tbl-ctrls">
<?=form_open($form_url)?>
	<?php if ( ! empty($upload) && is_numeric($dir)): ?>
	<fieldset class="tbl-search right">
		<a class="btn tn action" href="<?=$upload?>">Upload New File</a>
	</fieldset>
	<?php endif ?>
	<h1>
		<?php echo isset($cp_heading) ? $cp_heading : $cp_page_title?>
	</h1>

	<?=ee('CP/Alert')->getAllInlines()?>

	<?php if (isset($filters)) echo $filters; ?>

	<?php if($type == 'thumb'): ?>
	<div class="tbl-wrap">
		<table class='img-grid'>
		<?php foreach (array_chunk($files->asArray(), 5) as $row): ?>
			<tr>
				<?php foreach ($row as $file): ?>
				<td>
					<a data-id="<?=$file->file_id ?: $file->file_name ?>" data-url="<?=ee('CP/URL')->make($data_url_base, array('file' => $file->file_id))?>" class="filepicker-item" href="#">
						<?php if ($file->isImage()): ?>
						<img src="<?=$file->getAbsoluteThumbnailURL()?>" alt="<?=$file->file_name?>">
						<?php else: ?>
						<span class="file-thumb"><b><?=$file->file_name?></b></span>
						<?php endif; ?>
					</a>
				</td>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
		</table>
	</div>
	<?php else: ?>
		<?php $this->embed('ee:_shared/table', $table); ?>
	<?php endif; ?>

	<?php if ( ! empty($pagination)) echo $pagination; ?>

<?=form_close()?>
</div>
