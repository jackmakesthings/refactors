<?php $pagetype = 'contact';  include DIR_TMPL.'/header.php'; ?>
<header class="pageHeader contactHeader">
	<h1>Contact Us</h1>
</header>
<div class="gridWrapper aboutWrapper">
    <div class="top col3">
        <div class="col col1-3" style="padding-left:0;">
            <ul class="contactLocations">
                <h3>Contact us at our three showrooms</h3>
                <?php foreach ($locations as $location) : ?>
                <li class="location">
                    <em><?php echo $location['entry']['title'] ;?></em><br>
                    <?php echo deka('', $location, 'data', 'Address', 'data', 0);?><br>
                    <?php echo deka('', $location, 'data', 'Phone', 'data', 0);?></br>
                    <?php echo deka(FALSE, $location, 'data','Map link', 'data', 0) ? '<a class="mapLink" target="_blank" rel="external" href="' . $location['data']['Map link']['data'][0] . '">Map</a>' : '' ;?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col col2-3" style="padding-right:0;">
            <h2>Questions or comments?</h2>
            <form id="contact-us" name="contact-us" class="contact" method='POST'>
                <div class='error-notice'>
                <?php foreach($feedback as $err_msg){
                    echo $err_msg;
                }?>
                </div>
                <?php if(deka(FALSE, $data, 'success')):?>
                    <div>
                        <p>Thank you for your inquiry.  We will be in contact shortly.</p>
                    </div>
                <?php endif;?>
                <p id="req"><legend id="contactNote">Fields marked with * are required.</legend></p>
                <input type="text" placeholder="name *" name="contact[name]" id="name" class="text name" />
                <input type="text" placeholder="company" name="contact[company]" id="company" class="text company not-required" />
                <input type="text" placeholder="email *" name="contact[email]" id="email" class="text email" />
                <input type="text" placeholder="tel" name="contact[tel]" id="tel" class="text tel not-required" />
                <!-- <span class="selector" data-icon="R"></span> -->
                <span class="clearBreak"></span>
                <select id="subject" name="contact[subject]" class="select subject">
                    <option id="1" value="General Inquiry" name="1">General Inquiry</option>
                    <option id="2" value="Product Question" name="2">Product Question</option>
                </select>
                <textarea id="message" class="message" name="contact[message]" placeholder="message *"></textarea>
                <input type="submit" class="submit send contactSubmit" value="send">
            </form>
        </div>
    </div>
</div>
<div class="gridWrapper aboutWrapper">
    <section id="showrooms">
        <h2><span>Our Showrooms</span></h2>
        <ul> <?php
        foreach ($locations as $location) :
            if ($locImg = deka(FALSE, $location, 'data', 'Photo', 'data', 0)) :
                $locTitle = $location['entry']['title'];
                echo '<li class="loc"><img class="locImg" src="' . $file_loc . '/' . $locImg . '">';
                echo '<span class="locTitle">' . $locTitle . '</span></li>';
            endif;
        endforeach; ?>
        </ul>
    </section>
</div>

<?php include DIR_TMPL.'/footer.php'; ?>
