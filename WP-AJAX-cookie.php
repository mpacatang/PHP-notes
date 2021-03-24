
// Set Cookie AJAX
function mark_set_cookie() {
	// Just a basic botcheck to get rid of crawlers
	if( isset($_REQUEST['botcheck']) && $_REQUEST['botcheck'] == "6rupjf3FinzDGRJ3fBBaru4nAsXC" ){
		$year = 0;
		if( isset( $_REQUEST['year_id'] ) ) {
			$year = $_REQUEST['year_id'];
		}
		
		$make = 0;
		if( isset( $_REQUEST['make'] ) ) {
			$make = $_REQUEST['make'];
		}
		
		$model = 0;
		if( isset( $_REQUEST['model'] ) ) {
			$model = $_REQUEST['model'];
		}
		
		$engine = 0;
		if( isset( $_REQUEST['engine'] ) ) {
			$engine = $_REQUEST['engine'];
		}

		$cab = 0;
		if( isset( $_REQUEST['cab'] ) ) {
			$cab = $_REQUEST['cab'];
		}
		
		$box_size = 0;
		if( isset( $_REQUEST['box_size'] ) ) {
			$box_size = $_REQUEST['box_size'];
		}
		

		$term_id = '';
		if( $_error ) {
			$term_id = -1;
		} else {
			if ($cab > 0){
				$term_id = $cab;
			} else if( $box_size > 0 ) {
				$term_id = $box_size;
			}else if( $engine > 0 ) {
				$term_id = $engine;
			}else if( $model > 0 ) {
				$term_id = $model;
			} else if( $make > 0 ) {
				$term_id = $make;
			} else if( $year > 0 ) {
				$term_id = $year;
			}
		}

	echo  $term_id;
	
	$term = get_term_by('id', $term_id, 'product_ymm');
	$term_name = $term->name;

	
	while ($term_name == 'all'){
		
		$term_id = $term->parent;

		$term = get_term_by('id', $term_id, 'product_ymm');
		$term_name = $term->name;
	}

		vpf_ymm_set_cookie ( 'search', array (
			'year_id'	=> $year,
			'make'		=> $make,
			'model'		=> $model,
			'engine'	=> $engine,
			'cab'		=> $cab, 
			'box_size'	=> $box_size,
			'term_id'	=> $term_id
							
		) );

		
	}else{
		echo "Go away";
		exit();
	}

}
<script>
jQuery( document ).ready(function($) {


    // Set Car Cookie
    $('#setCar').on('click', function(e){
      e.preventDefault();



      jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action: 'mark_set_cookie',
          // add your parameters here
          year_id: $('select[name="year_id"]').val(),
          make: $('select[name="make"]').val(),
          model: $('select[name="model"]').val(),
          engine: $('select[name="engine"]').val(),
          cab: $('select[name="cab"]').val(),
          box_size: $('select[name="box"]').val(),
          botcheck: '6rupjf3FinzDGRJ3fBBaru4nAsXC'
        },
        success: function (output) {
           console.log(output);
           window.location.href = '/shop';
        }
        });


    });
	});

</script>
