<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $d['pname']; ?></td>
  <td><?php echo $d['p_atk']; ?></td>
  <td><?php echo $d['p_def']; ?></td>
  <td><?php echo $d['p_hp']; ?></td>
  <td><?php echo $d['p_mp']; ?></td>
  <td><?php echo $d['attr']; ?></td>
  <td><?php echo $d['create_time']; ?></td>
  <td>
    <form class="delete_prop" method="post" >
      <input type="hidden" name="prop" id="prop" value="<?php echo $d['b_id'];?>">
      <input type="submit" name="submit" value="刪除">
    </form>
  </td>
</tr>