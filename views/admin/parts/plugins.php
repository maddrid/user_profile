<?php
require(USER_PROFILE_PATH . 'lib/phpQuery/phpQuery.php');
$html = osc_file_get_contents('https://market.osclass.org/user/profile/25723');
 $filename = USER_PROFILE_PATH . 'lib/phpQuery/cache/profile.html';
 $fileurl = USER_PROFILE_URL . 'lib/phpQuery/cache/profile.html';
  if (!file_exists($filename)){
      $html = osc_file_get_contents('https://market.osclass.org/user/profile/25723');
		$fp = fopen($filename, "w") or die("can't open file");;

	 fwrite($fp, $html);
	 fclose($fp);
         }else{
         $html = osc_file_get_contents($fileurl);
         }

$docs = phpQuery::newDocument($html);
$plugins = [];
foreach ($docs['.row .col-xs-12 .grid-listing'] as $row) {
    $plugin ['name'] = trim(pq($row)->find('.title')->text());
    $plugin ['description'] = pq($row)->find('.description')->text();
    $plugin['image'] = trim(pq($row)->find('img')->attr('src'));
    $plugin ['price'] = pq($row)->find('.price')->text();
    $plugin ['sales'] = trim(pq($row)->find('.sales-container')->text());
    $plugin ['url'] = trim(pq($row)->find('a')->attr('href'));
    $type = explode('/', $plugin['url']);
    $plugin['type'] = $type[4];
    $plugins[] = $plugin;
}
?>
<div class="row half-gutters align-middle">
    <div class="column shrink mobile-100 mobile-order-1">
        <h3><?php _e('Plugins by same developer', 'user_profile');?></h3>
    </div>

</div>
<div class="dario divider"></div>
<div class="dario space divider"></div>
<?php if (count($plugins) == 0){ ?>
    <div class="content-center"><img src="<?php echo USER_PROFILE_URL; ?>assets/images/notfound.png" alt="">
        <p class="dario small thick caps text"><?php echo 'No Plugins'; ?></p>
    </div>
<?php }else{ ?>
    <div class="dario big space divider"></div>
    <div class="dario items-list-view">
        <?php foreach ($plugins as $row): ?>
            <div class="item" id="item_">
                <div class="dario photo acard attached">
                    <div class="image">
                        <img src="<?php echo $row['image'] ?>" alt="" class="dario basic big image">
                        <div class="description">

                            <div class="meta"> <span class="dario bold large white text">

                                    <a class="white" href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a>

                                </span>
                                <div><span class="dario small primary label"><?php echo $row['type']; ?></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="header">
                        <div class="inner">
                            <div class="row no-all-gutters align-middle">
                                <div class="column"><?php echo $row['price']; ?></div>
                                <div class="column shrink">
                                    <span class="dario small positive label">
                                        <a class="green" href="<?php echo $row['url']; ?>">Buy</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="dario list">
                            <div class="item">
                                <div class="content"><?php echo $row['description']; ?></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php } ?>


