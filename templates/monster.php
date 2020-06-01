<tr>
  <th><?php echo $m['name']; ?></th>
  <th><?php echo $_SESSION[$m['name']]['atk']; ?></th>
  <th><?php echo $_SESSION[$m['name']]['def']; ?></th>
  <th><?php echo $_SESSION[$m['name']]['hp']; ?></th>
  <th><?php echo $prop[0]['name']; ?></th>
  <th>
    <form class="attack">
      <input type="hidden" name="decide" id="decide" value="<?php echo $_SESSION['decide']; ?>">
      <input type="hidden" name="monster_id" id="monster_id" value="<?php echo $m['id'];?>">
      <input type="submit" name="submit" value="打他">
    </form>
  </th>
</tr>