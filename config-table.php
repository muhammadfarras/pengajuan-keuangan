<form action="config-run.php" method="post"> 
 <table>
 
 <tr><th colspan=2 style="text-align: center">Data pribadi</th></tr>
 <tr><td>Nama</td><td><?php echo $data['nama']; ?></td></tr>
 <tr><td>No Hape</td><td><?php echo $data['no_hp']; ?></td></tr>
 <tr><td>email</td><td><?php echo $data['email'];; ?></td></tr>
 
 <tr>
  <th colspan=2 style="text-align: center">
   <input name='cair' type='submit' class='config' style='font-family: FontAwesome'; value='&#xf084';>
  </th>
 </tr>
</table>
</form>