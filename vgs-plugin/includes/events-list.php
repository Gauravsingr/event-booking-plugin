

<table border="1" class="table"> 
<tr>
<th>Event Name</th>
<th>Event Oranizer</th>
<th>Event date</th>
<th>Number of People</th>
<th>Event description</th>
<th>Event status</th>

</tr>
<?php
global $wpdb;
$result = $wpdb->get_results ( "SELECT * FROM wp_add_event" );
foreach ( $result as $print ) {
?>
<tr>
<td><?php echo $print->event_name;?></td>
<td><?php echo $print->event_organizer;?></td>
<td><?php echo $print->event_date;?></td>
<td><?php echo $print->number_people;?></td>
<td><?php echo $print->event_description;?></td>
<td><?php echo $print->event_status;?></td>
</tr>
<?php
}
?>
</table>

 