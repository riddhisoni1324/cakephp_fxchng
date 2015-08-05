
<!-- <div class="searchkeywords" id="divsearch2">
    <h4>Search by Keywords</h4>

    <input type="text" name="hsearch5" id="left_main_search_textbox" value="" class="searchinput" placeholder="E.g. mobile, car, sofa..." />
    <input type="button" value="" class="btnsearchsmall" id="left_main_search" />

    <div class="clear"></div>
</div> --> <!-- end of searchkeywords> -->

<div class="leftaccordian">

    <div class="accordiantitle">
        <!-- <a href="#" >All Categories</a> -->
    </div> <!-- end of accordiantitle -->

    <div class="panel-group" id="accordion">

        <!-- <div class="panel panel-default">
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="carcount">
                        <strong>Mobile Phones</strong>
                    </div>
                </div>
            </div>
        </div> --> <!-- "panel panel-default" -->

        <div class="price"> Ad Type
            <div class="makecheckbox martop10">
                <table>
                    <tr id="dealsForm2">
                        <td class="typesubcat padleft10">
                            <input type="checkbox" name="subtype1" id="left_used" value="used" />
                            <td class="padleft10">Used</td>
                        </td>
                    </tr>
                    <tr id="dealsForm2">
                        <td class="typesubcat padleft10">
                            <input type="checkbox" name="subtype1" id="left_new" value="new"/>
                            <td class="padleft10">New</td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- <div class="price"> Ad Posted In
            <div class="makecheckbox martop10">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablepaddbtm">
                    <tr id="1_day"><td class=""><a>Last 24 Hrs</a></td></tr>
                    <tr id="7_days"><td class=""><a>Last 7 Days </a></td></tr>
                    <tr id="10_days"><td class=""><a>Last 10 Days</a> </td></tr>
                    <tr id="15_days"><td class=""><a>Last 15 Days</a> </td></tr>
                    <tr id="30_days"><td class=""><a>Last 30 Days</a> </td></tr>
                </table>
            </div>
        </div> -->

        <div class="price">Ad Posted by
            <div class="makecheckbox martop10">
                <table>
                    <tr>
                        <td class="typesubcat padleft10">
                        <input type="checkbox" name="individual" id="left_individual" value="individual"/>
                        </td>
                      <td class="padleft10">Individual</td>
                    </tr>
                    <tr>
                        <td class="typesubcat padleft10">
                        <input type="checkbox" name="dealer" id="left_dealer" value="dealer"/>
                        </td>
                        <td class="padleft10">Dealer</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="price"> Price
            <div class="priceinput">
                <div>
                    <input type="text" class="priceinputin" name='minvalue' value="" id='left_minvalue' placeholder="Min" />
                </div>
                <span>-</span>
                <div>
                    <input type="text" class="priceinputin" placeholder="Max" value="" name='maxvalue' id='left_maxvalue'/>
                </div>
                <div>
                    <!-- <img style="display:none;" src="" alt="" class="btngo" />
                    <input name="btnsubmitprice" type="submit" value="" align="right" class="btnprice"/> -->
                    <?php echo $this->Form->submit('', array('class' => 'btnprice', 'id' => 'left_price_submit')); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div> <!-- end of "panel-group" -->
</div> <!-- end of leftaccordian -->

