<?php foreach($leads as $lead): ?>
    <li><a href="<?php echo site_url("history/view/".$lead['id']) ?>" data-transition="slide"><?php echo $lead['data']['name'] ?></a></li>
<?php endforeach; ?>
<?php if(count($leads) == 0): ?>
    <li>No data found</li>
<?php endif; ?>
