<?php
   echo "Daftar User Banjarbaru Bagawi ";
   ?>
<table>
<tr>
<td >User Name</td>
<td> NIP </td>
<td> Nama Pegawai </td>

</tr>
<?php foreach ($model as $user) {
       echo "<tr>";
       echo "<td>'$user->username'</td>";
       echo "<td>   '$user->nip'  </td>";
       echo "<td>  $user->nama_pegawai  </td>";


       echo "</tr>";
   }
    ?>
</table>