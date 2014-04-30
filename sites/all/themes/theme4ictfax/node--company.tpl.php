<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
 global $user;
 $account = user_load($user->uid);
 function theme4ictfax_get_custom_user_fields($username,$field)
 {
   $fieldinfo = field_get_items('user', $username, $field);
   $fieldvalue = '';
   if ($fieldinfo) {
     $fieldvalue = field_view_value('user',$username, $field, $fieldinfo[0]);
   }
   return $fieldvalue;
 };
 
 function theme4ictfax_get_field($content_v, $field)
 {
   $fieldinfo = field_get_items('node', $content_v, $field);
   $fieldvalue='';
   if ($fieldinfo) {
     $fieldvalue = field_view_value('node',$content_v, $field, $fieldinfo[0]);
   }
   return $fieldvalue;

 }
?>
<?php if(isset($_GET['q']) && ($_GET['q'] != 'printpdf/' . $node->nid)) { ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>
<?php } ?>
  <div class="content clearfix"<?php print $content_attributes; ?>>
<p>
<?php
 $department = theme4ictfax_get_custom_user_fields($account,'field_department');

 $office = theme4ictfax_get_custom_user_fields($account,'field_physicaldeliveryofficename');
 if(empty($office)) {$office = theme4ictfax_get_field($node, 'field_default_office');}

 $address = theme4ictfax_get_custom_user_fields($account,'field_streetaddress');
 if(empty($address)) {$address = theme4ictfax_get_field($node,'field_default_address');}

 $city = theme4ictfax_get_custom_user_fields($account,'field_l');
 if(empty($city)) {$city = theme4ictfax_get_field($node,'field_default_city');}

 $state = theme4ictfax_get_custom_user_fields($account,'field_st');
 if(empty($state)) {$state = theme4ictfax_get_field($node,'field_default_state');}

 $country = theme4ictfax_get_custom_user_fields($account,'field_c');
 if(empty($country)) {$country = theme4ictfax_get_field($node,'field_default_country');}

 $postal = theme4ictfax_get_custom_user_fields($account,'field_postalcode');
if(empty($postal)) {$postal = theme4ictfax_get_field($node,'field_default_postal_code');}
 
$faxmach = theme4ictfax_get_custom_user_fields($account,'field_facsimiletelephonenumber');
if(empty($faxmach)) {$faxmach = theme4ictfax_get_field($node,'field_default_fax');}

$website = theme4ictfax_get_field($node,'field_company_website');

$cn = theme4ictfax_get_custom_user_fields($account,'field_cn');
$usertitle = theme4ictfax_get_custom_user_fields($account,'field_title');
$email = theme4ictfax_get_custom_user_fields($account,'field_mail');
$telephone = theme4ictfax_get_custom_user_fields($account,'field_telephonenumber');
$mobile = theme4ictfax_get_custom_user_fields($account,'field_mobile');
$tofax = '';
$subject = '';
$to = '';

?>
</p>
   <?php

      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
    ?>
    <div style="float:left; width:50%;">
    <?php print render($content['field_company_logo']);
    print '<p>' . render($content['field_company_phone_number']);
    print render($content['field_company_toll_free']);
    print render($content['field_company_cellphone']);
    print render($content['field_toll_free_fax']);
    if($website)  print '<a href="http://' . $website['#markup'] . '" target="_blank">' . render($website) . '</a>';
    print render($content['field_company_email']); ?>
    </p>
    </div>
    <div style="float:right; width:50%;">
    <h3><strong><?php print render($content['field_company_name']); ?></strong></h3>
    <p><?php print render($office); ?> Office
    <br/>Department:&nbsp;<?php print render($department); ?></p>
    <p><?php print render($address); ?><br/>
    <?php print render($city); ?>,&nbsp;
    <?php print render($state); ?>,&nbsp;
    <?php print render($country); ?><br/>
    <?php print render($postal); ?></p>
    </div>
    <hr style="clear:both; width:100%;"/>
    
    <form name="input" action="" method="get">
    <div style="float:left; width:50%">
    <p>From Fax: <?php print render($faxmach); ?><br/>
    Date: <?php print date('D M d, Y h:i:s a', time()); ?></p>
    <p style="margin-bottom:0px;">From:</br><?php print render($cn); ?><br/>
    <?php if($title) { print render($usertitle) . '<br/>'; }
    if($email) { print '<a href=\'mailto:' . $email['#markup'] . '\'>' . render($email) .  '</a><br/>'; } ?>
    </p>
    <style>
    #numbertable table,th,td,tr
    {
      border:1px none white;
      border-collapse:collapse;
      background:none;
      background-repeat:no-repeat;
      background-color:none;
      padding:0px !important;
      margin:0px !important;
    }
    </style>
    <table class="numbertable">
    <tbody class="numbertable">
      <?php if($telephone) { print '<tr class="numbertable"><td>Telephone</td><td>' .render($telephone) . '</td></tr>'; }
      if($mobile) { print '<tr class="numbertable"><td>Cell</td><td>' . render($mobile) . '</td></tr>'; }
      if($faxmach) { print '<tr class="numbertable"><td>Fax</td><td>' . render($faxmach) . '</td></tr>'; } ?>
    </tbody>
    </table>
    </div>
    <div style="float:right; width:50%;">
    <p>
    <table class="numbertable">
    <tbody class="numbertable">
    <tr><td>To Fax:</td><td><input type="text" name="tofax"
    <?php if(isset($_GET['tofax'])) print 'value="' . $_GET['tofax'] . '"'; 
      if((isset($_GET['q']) && ($_GET['q'] == 'node/' . $node->nid)))
        print ' placeholder="To Fax"'; ?>/></td></tr>
    <tr><td>To:</td><td><input type="text" name="toperson" 
    <?php if(isset($_GET['toperson'])) print 'value="' . $_GET['toperson'] . '"'; 
      if((isset($_GET['q']) && ($_GET['q'] == 'node/' . $node->nid)))
        print ' placeholder="To Person"'; ?>/></td></tr>
    <tr><td>Subject:</td><td><input type="text" name="subject" 
    <?php if(isset($_GET['subject'])) print 'value="' . $_GET['subject'] . '"';
      if((isset($_GET['q']) && ($_GET['q'] == 'node/' . $node->nid)))
        print ' placeholder="Subject"'; ?>/></td></tr>
    </tbody>
    </table>
    </p>
    </div>
    <div style="clear:both; float:right; width:45%;">
    <input type="hidden" name="q" value="printpdf/<?php print $node->nid ;?>" />
    <?php if(isset($_GET['q']) && ($_GET['q'] != 'printpdf/' . $node->nid)) { ?>
       <input id="company-submit" type="submit" name="Submit" value="Submit" align="right"/>
    <?php } ?>
    </div>
    </form>
  </div>

  <?php if(isset($_GET['q']) && ($_GET['q'] != 'printpdf/' . $node->nid)) { ?>
  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
  <?php } ?>  

</div>
