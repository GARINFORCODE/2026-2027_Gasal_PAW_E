<?php
include 'cek_owner.php';
include 'koneksi.php';
$t = $cfg['table']; $pk = $cfg['pk']; $f = $cfg['fields'];
$self = basename($_SERVER['PHP_SELF']);

if (isset($_GET['hapus'])) {
    $s = $conn->prepare("DELETE FROM $t WHERE $pk=?");
    $s->bind_param("i", $_GET['hapus']); $s->execute();
    header("Location: $self"); exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cols = []; $vals = [];
    foreach ($f as $c => $m) {
        $v = $_POST[$c] ?? '';
        if ($m[1] == 'password') {
            if ($v === '' && !empty($_POST['id'])) continue;
            $v = password_hash($v, PASSWORD_DEFAULT);
        }
        $cols[] = $c; $vals[] = $v;
    }
    if (!empty($_POST['id'])) {
        $set = implode(',', array_map(fn($c) => "$c=?", $cols));
        $s = $conn->prepare("UPDATE $t SET $set WHERE $pk=?");
        $vals[] = $_POST['id'];
    } else {
        $s = $conn->prepare("INSERT INTO $t (" . implode(',', $cols) . ") VALUES (" . implode(',', array_fill(0, count($cols), '?')) . ")");
    }
    $s->bind_param(str_repeat('s', count($vals)), ...$vals);
    $s->execute();
    header("Location: $self"); exit;
}
$edit = null;
if (isset($_GET['edit'])) {
    $s = $conn->prepare("SELECT * FROM $t WHERE $pk=?");
    $s->bind_param("i", $_GET['edit']); $s->execute();
    $edit = $s->get_result()->fetch_assoc();
}
include 'navbar.php';
?>
<h2><?= $cfg['title'] ?></h2>
<form method="POST">
  <input type="hidden" name="id" value="<?= $edit[$pk] ?? '' ?>">
  <?php foreach ($f as $c => $m): ?>
    <?= $m[0] ?>:
    <?php if ($m[1] == 'select'): ?>
      <select name="<?= $c ?>">
        <?php foreach ($m[2] as $k => $lbl): ?>
          <option value="<?= $k ?>" <?= (($edit[$c] ?? '') == $k) ? 'selected' : '' ?>><?= $lbl ?></option>
        <?php endforeach; ?>
      </select>
    <?php elseif ($m[1] == 'password'): ?>
      <input type="password" name="<?= $c ?>" <?= $edit ? 'placeholder="kosongkan jika tidak diubah"' : 'required' ?>>
    <?php else: ?>
      <input type="<?= $m[1] ?>" name="<?= $c ?>" value="<?= htmlspecialchars($edit[$c] ?? '') ?>" required>
    <?php endif; ?>
  <?php endforeach; ?>
  <input type="submit" value="<?= $edit ? 'Update' : 'Tambah' ?>">
  <?php if ($edit) echo "<a href='$self'>Batal</a>"; ?>
</form><br>
<table>
  <tr><th>ID</th>
  <?php foreach ($f as $c => $m) if ($m[1] != 'password') echo "<th>{$m[0]}</th>"; ?>
  <th>Aksi</th></tr>
  <?php $r = $conn->query("SELECT * FROM $t ORDER BY $pk"); while ($row = $r->fetch_assoc()): ?>
  <tr><td><?= $row[$pk] ?></td>
    <?php foreach ($f as $c => $m) if ($m[1] != 'password')
      echo "<td>" . htmlspecialchars($m[1] == 'select' ? ($m[2][$row[$c]] ?? $row[$c]) : $row[$c]) . "</td>"; ?>
    <td><a href="?edit=<?= $row[$pk] ?>">Edit</a> |
        <a href="?hapus=<?= $row[$pk] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a></td></tr>
  <?php endwhile; ?>
</table>
</div></body></html>
