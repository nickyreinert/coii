<div id="coii-modal-dialogue">

        <p>
            <?php echo get_option('coii_dialogue'); ?>
        </p>

    <p>
        <button id="enable-tracking">
	        <?php echo get_option('coii_yes_button'); ?>
        </button>

        <button id="disable-tracking">
	        <?php echo get_option('coii_no_button'); ?>
        </button>

    </p>

</div>

<script type="text/javascript">

    (function( $ ) {

        $("#enable-tracking").click(function(){


            // $tracking_pixel_array are defined in class-coii-public.php
			<?php foreach ($tracking_pixel_array as $script_index => $tracking_script) { ?>

				var script<?php echo $script_index; ?> = document.createElement("script");

				<?php if ($tracking_script['src'] != FALSE) { ?>

					$(script<?php echo $script_index; ?>).attr('src', '<?php echo $tracking_script['src']; ?>');

				<?php } ?>

				script<?php echo $script_index; ?>.innerHTML = '<?php echo $tracking_script['text']; ?>';

				document.body.appendChild(script<?php echo $script_index; ?>);

			<?php } ?>

            createCookie('coii_allow_tracking_pixel', 'yes', 360);

            $("#coii-modal-dialogue").fadeOut( "slow", function() {});

        });

    })( jQuery );


</script>
