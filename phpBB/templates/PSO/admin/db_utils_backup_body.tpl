
<br clear="all" />

<h1>{L_DATABASE_BACKUP}</h1>

<P>{L_BACKUP_EXPLAIN}</p>

<form method="post" action="{S_DBUTILS_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center">
	<tr>
		<th colspan="2">{L_BACKUP_OPTIONS}</th>
	</tr>
	<tr>
		<td class="row2">{L_FULL_BACKUP}</td>
		<td class="row2"><input type="radio" name="backup_type" value="full" checked="checked" /></td>
	</tr>
	<tr>
		<td class="row1">{L_STRUCTURE_BACKUP}</td>
		<td class="row1"><input type="radio" name="backup_type" value="structure" /></td>
	</tr>
	<tr>
		<td class="row2">{L_DATA_BACKUP}</td>
		<td class="row2"><input type="radio" name="backup_type" value="data" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ADDITIONAL_TABLES}</td>
		<td class="row1"><input type="text" name="additional_tables" /></td>
	</tr>
	<tr>
		<td class="row1">{L_GZIP_COMPRESS}</td>
		<td class="row1">{L_NO} <input type="radio" name="gzipcompress" value="0" checked="checked" /> &nbsp;{L_YES} <input type="radio" name="gzipcompress" value="1" /></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="backupstart" value="{L_START_BACKUP}" /></td>
	</tr>
</table></form>

<br clear="all" />
