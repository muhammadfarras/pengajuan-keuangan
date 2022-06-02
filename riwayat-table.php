 <table>
 
 <tr><th colspan=2 style="text-align: center">Riwayat Pengajuan</th></tr>
 <tr><td>Pengaju</td><td><?php echo $data[0]['nama_pengajuan']; ?></td></tr>
 <tr><td>Nominal pengajuan</td><td><?php echo number_format ($data[0]['nominal_pengajuan']); ?></td></tr>
 <tr><td>Waktu pengajuan</td><td><?php echo $data[0]['waktu_pengajuan']; ?></td></tr>
 <tr><td>Keterangan</td><td><?php echo $data[0]['keterangan']; ?></td></tr>
 <tr><td>Lampiran</td><td><?php echo $data[0]['lampiran']; ?></td></tr>
 
 <tr><th colspan=2 style="text-align: center">Riwayat Persetujuan</th></tr>
 <tr><td>Penyetuju</td><td><?php echo $data[1]['administrator']; ?></td></tr>
 <tr><td>Waktu pengajuan</td><td><?php echo $data[1]['waktu_persetujuan']; ?></td></tr>
 
 <tr><th colspan=2 style="text-align: center">Riwayat Pengambilan Dana</th></tr>
 <tr><td>Nominal pengambilan</td><td><?php echo number_format($data[2]['nominal_pengambilan']); ?></td></tr>
 <tr><td>Kasir</td><td><?php echo $data[2]['kasir']; ?></td></tr>
 <tr><td>Waktu pengambilan</td><td><?php echo $data[2]['waktu_pengambil']; ?></td></tr>
 
 <tr><th colspan=2 style="text-align: center">Riwayat Pelaporan</th></tr>
 <tr><td>Nominal penggunaan</td><td><?php echo number_format ($data[3]['nominal_laporan']); ?></td></tr>
 <tr><td>Pelapor</td><td><?php echo $data[3]['pelapor']; ?></td></tr>
 <tr><td>Lampiran</td><td><?php echo $data[3]['lampiran_laporan']; ?></td></tr>
 <tr><td>Waktu pelaporan</td><td><?php echo $data[3]['waktu_pelaporan']; ?></td></tr>
 
</table>