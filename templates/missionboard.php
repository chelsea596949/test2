<tr>
  <td><?php echo $mi['mi_name']?></td>
  <td><?php echo $mi['pname']?></td>
  <?php if($mission_statement[$j] == '未接取') :?>
  <td>
    <form class="accept_mission">
      <input type="hidden" name="mission" id="mission" value="<?php echo $mi['mi_id']; ?>">
      <input type="submit" value="√">
    </form>
  <?php else:?>
    <td></td>
  <?php endif;?>
  </td>
  <td><?php echo $mission_statement[$j];?></td>
  <td><?php echo $my_mission_prop[0]['quantity'];?></td>
  <?php if($mission_statement[$j] == '進行中' && $my_mission_prop[0]['quantity'] > 0) :?>
      <td><form class="complete_mission">
      <input type="hidden" name="done" id="done" value="<?php echo $mi['mi_id']; ?>">
      <input type="submit" name="submit" value="完成任務">
      </form></td>
  <?php else:?>
      <td></td>
  <?php endif;?>
</tr>