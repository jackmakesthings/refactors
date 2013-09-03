<?php
$output = '';
$output .= $from['name'] . " thought you might be interested in this item at John Salibello. \n\n";
$output .= "Sender's note: " . $message  . "\n";
	foreach ($products['products'] as &$product):
		$product = Salibello::make_nice_product($product);
		$output .= $product['title'] . "\n";
		$output .= $product['by_designer'] . "\n";
		$output .= 'Item number: ' . $product['number'];
		$output .=  "\n" . $product['desc'] . "\n";
		foreach($product['details'] as $key => &$detail):
            if($key === 'moredims'){
                foreach($detail as &$dim):
                    $key = deka('', $dim, 'key', 0);
                    $val = deka('', $dim, 'data', 0);
                    if (strlen($key) && strlen($val)):
                        $output .= "\n";
                        $output .= $key . ': ' . $val . '"';
                        $output .= "\n";
                    endif;
                endforeach;
            }
            else{
                $output .= $key . ': ' . $detail . "\n";
            }
		endforeach;
	endforeach;
$output  .= 'See the entire John Salibello collection or contact us at johnsalibello.com.';
$return = strip_tags($output);
echo $return; return $return;
?>
