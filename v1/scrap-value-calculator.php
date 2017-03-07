<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Scrap Value Calculator';



$adminClass = new Admin();



// Include the library
include('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://www.kitco.com/market/');

foreach ( $html->find('td#AU-bid') as $element ) {
   $cur_gold_price = $element->plaintext;
}

foreach ( $html->find('td#AG-bid') as $element ) {
    $cur_silver_price = $element->plaintext;
}

$scrap_setting = $adminClass->getScrapHoldingDays();

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left" style="padding-top: 5px;">
                <i class="icon icon-diamond"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Scrap Value Calculator</li>
                </ul>
                <h4>Scrap Value Calculator</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

 
        <div class="col-lg-12">
                    <div class="col-lg-2">

                        <div class="col-lg-12">
                            <div class="row">
                                <h4 class="box-heading">Karat Type</h4>
                                <div class="panel panel-default" id="karat">

                                    <div class="panel-body">

                                    <div class="rdio rdio-primary">
                                        <input id="10kt" type="radio" value="41.7" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="10kt">
                                            10kt
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="14kt" type="radio" value="58.5" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="14kt">
                                            14kt
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="18kt" type="radio" value="75" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="18kt">
                                            18kt
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="22kt" type="radio" value="91.60" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="22kt">
                                            22kt
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="24kt" type="radio" value="100" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="24kt">
                                            24kt
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="sterling" type="radio" value="92.5" name="radio1" class="radio_k" onclick="calcValue()">
                                        <label for="sterling">
                                            Sterling Silver
                                        </label>
                                    </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-3">

                        <div class="col-lg-12">
                            <div class="row">
                                <h4 class="box-heading">Measurement</h4>
                                <div class="panel panel-default" id="measurement">
                                    <div class="panel-body">
                                    <div class="rdio rdio-primary">
                                        <input id="grams" type="radio" value="grams" name="radio" class="radio_m" onclick="calcValue()" checked>
                                        <label for="grams">
                                            Grams(G)
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="penny" type="radio" value="penny" name="radio" class="radio_m" onclick="calcValue()">
                                        <label for="penny">
                                            Penny Weight (D.W.T.)
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="ounce" type="radio" value="ounce" name="radio" class="radio_m" onclick="calcValue()">
                                        <label for="ounce">
                                            Ounce(Oz)
                                        </label>
                                    </div>
                                    <br>
                                    <div class="rdio rdio-primary">
                                        <input id="troy" type="radio" value="troy" name="radio" class="radio_m" onclick="calcValue()">
                                        <label for="troy">
                                            Troy Oz (T Oz)
                                        </label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <h4 class="box-heading">Total Weight</h4>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                    <div class="row">
                                        <label for="weight">Metal weight</label>
                                        <input type="number" class="form-control col-lg-12" name="weight" id="weight" value="0" placeholder="Metal weight" onChange="calcValue()">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="gem_weight">Gem weight</label>
                                        <input type="number" class="form-control col-lg-12" name="gem_weight" id="gem_weight" value="0" placeholder="Gem weight" onChange="calcValue()">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <a class="btn btn-primary" href="http://dendritics.com/carat-weight/" target="_blank">Calculate Gem Weights</a>
                                    </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="col-lg-12">
                            <div class="row">
                                <h4 class="box-heading">Gold</h4>
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                    <label>Current Gold Price</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="cur_gold_price" id="cur_gold_price" value="<?php echo $cur_gold_price; ?>" onChange="calcValue()">
                                    </div>
                                    <small><i>you can manually enter this amount</i></small>

                                    <br>
                                    <br>
                                    <label>Retail Market Value</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="gold_rmv" id="gold_rmv" disabled>
                                    </div>
                                    <br>

                                    <label>Percentage</label>
                                    <div class="input-group input-group-lg text-align">

                                        <input type="number" class="form-control" name="gold_perc" id="gold_perc" value="50" onChange="calcValue()" data-toggle="tooltip" data-placement="top" title="Maximum Allowed Payout is <?php echo $scrap_setting[0]['max']; ?>%">
                                        <span class="input-group-addon">%</span>

                                    </div>
                                    <small><i>percentage you want to lend/buy</i></small>
                                    <br>

                                    <br>
                                    <label>Lend Buy Value</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="gold_lbv" id="gold_lbv" disabled>
                                    </div>

                                </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">

                        <div class="col-lg-12">
                            <div class="row">
                                <h4 class="box-heading">Silver</h4>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                    <label>Current Silver Price</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="cur_silver_price" id="cur_silver_price" value="<?php echo $cur_silver_price; ?>">
                                    </div>
                                    <small><i>you can manually enter this amount</i></small>

                                    <br>
                                    <br>
                                    <label>Retail Market Value</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="silver_rmv" id="silver_rmv" disabled>
                                    </div>
                                    <br>

                                    <label>Percentage</label>
                                    <div class="input-group input-group-lg text-align">

                                        <input type="number" class="form-control" name="silver_perc" value="50" id="silver_perc" onChange="calcValue()" data-toggle="tooltip" data-placement="top" title="Maximum Allowed Payout is <?php echo $scrap_setting[0]['max']; ?>%">
                                        <span class="input-group-addon">%</span>

                                    </div>
                                    <small><i>percentage you want to lend/buy</i></small>
                                    <br>

                                    <br>
                                    <label>Lend Buy Value</label>
                                    <div class="input-group input-group-lg text-align">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="silver_lbv" id="silver_lbv" disabled>
                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>







                </div>

        


    </div><!-- contentpanel -->

</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>


        <script>

            function calcValue(){
                var measurement = $('#measurement input:radio:checked');
                var karat = $('#karat input:radio:checked');
                var m_value = measurement.attr('value');
                var k_value = parseFloat(karat.attr('value')) / 100;
                var gem_weight = parseFloat($('#gem_weight').val());
                var max_perc_limit = "<?php echo $scrap_setting[0]['max']; ?>";


                var metal_weight = $('#weight').val();
                if(m_value == 'grams'){
                    metal_weight = metal_weight;
                }else if(m_value == 'penny'){
                    metal_weight = metal_weight * 1.55517;
                }else if(m_value == 'ounce'){
                    metal_weight = metal_weight * 28.3495;
                }else if(m_value == 'troy'){
                    metal_weight = metal_weight * 31.103;
                }

                var weight = parseFloat(metal_weight) - gem_weight;
                if(k_value != 0.925){

                    var cur_gold_price = $('#cur_gold_price').val();
                    var gold_gram_price = parseFloat(cur_gold_price) / 31.103;
                    var actual_gold = parseFloat(weight) * k_value;
                    var gold_rmv = actual_gold * gold_gram_price;
                    var gold_perc = parseFloat($('#gold_perc').val()) / 100;
                     var payout = gold_rmv * gold_perc;

                        if(gold_perc > max_perc_limit / 100 ){
                            $('#gold_perc').val(max_perc_limit);
                        }


                         $('#gold_rmv').val(gold_rmv.toFixed(2));
                         $('#gold_lbv').val(payout.toFixed(2));

                         $('#silver_rmv').val(0);
                    $('#silver_lbv').val(0);

                }else if(k_value == 0.925){

                    var cur_silver_price = $('#cur_silver_price').val();

                    var silver_gram_price = parseFloat(cur_silver_price) / 31.103;
                    var actual_silver = parseFloat(weight) * k_value;
                    var silver_rmv = actual_silver * silver_gram_price;
                    var silver_perc = parseFloat($('#silver_perc').val()) / 100;
                    var silver_payout = silver_rmv * silver_perc;

                     if(silver_perc > max_perc_limit / 100 ){
                            $('#silver_perc').val(max_perc_limit);
                        }
                    $('#silver_rmv').val(silver_rmv.toFixed(2));
                    $('#silver_lbv').val(silver_payout.toFixed(2));

                         $('#gold_rmv').val(0);
                         $('#gold_lbv').val(0);


                }









            }


        </script>


<?php

require SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>