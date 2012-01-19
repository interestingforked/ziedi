<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li>1</li><li  class="current">2. Piegādes laiks un adrese</li><li>3</li><li>4</li>
            </ul>
        </div>
        <div class="over-ordering">
            <table class="ordering">
                <tr>
                    <td class="first">Piegādes datums</td>
                    <td>
                        <select size="1" class="form-select" name="order[shipping_date_day]" id="shipping_date_day" onchange="OrderIssueForm.formUpdated('shipping_date');">
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="6" >6</option>
                            <option value="7" >7</option>
                            <option value="8" >8</option>
                            <option value="9" >9</option>
                            <option value="10" >10</option>
                            <option value="11" >11</option>
                            <option value="12" selected>12</option>
                            <option value="13" >13</option>
                            <option value="14" >14</option>
                            <option value="15" >15</option>
                            <option value="16" >16</option>
                            <option value="17" >17</option>
                            <option value="18" >18</option>
                            <option value="19" >19</option>
                            <option value="20" >20</option>
                            <option value="21" >21</option>
                            <option value="22" >22</option>
                            <option value="23" >23</option>
                            <option value="24" >24</option>
                            <option value="25" >25</option>
                            <option value="26" >26</option>
                            <option value="27" >27</option>
                            <option value="28" >28</option>
                            <option value="29" >29</option>
                            <option value="30" >30</option>
                            <option value="31" >31</option>
                        </select>
                        <select size="1" class="form-select" name="order[shipping_date_month]" id="shipping_date_month" onchange="OrderIssueForm.formUpdated('shipping_date');">
                            <option value="1" >janvārī</option>
                            <option value="2" >februārī</option>
                            <option value="3" >martā</option>
                            <option value="4" >aprīlī</option>
                            <option value="5" >maijā</option>
                            <option value="6" >jūnijā</option>
                            <option value="7" >jūlijā</option>
                            <option value="8" >augustā</option>
                            <option value="9" >septembrī</option>
                            <option value="10" >oktobrī</option>
                            <option value="11" selected>novembrī</option>
                            <option value="12" >decembrī</option>
                        </select>
                        <select size="1" class="form-select" name="order[shipping_date_year]" id="shipping_date_year" onchange="OrderIssueForm.formUpdated('shipping_date');">
                            <option value="2011" selected>2011</option>
                            <option value="2012" >2012</option>
                        </select>
                    </td> 
                </tr>
                <tr style="display:none;">
                    <td></td><td><span id="shipping_date_error" style="color: red; font-weight: bold;">Šīs datums ir pagatnē</span></td>
                </tr>
                <tr>
                    <td class="first">Piegādes laiks</td>
                    <td>
                        <select size="1" class="form-select" name="order[shipping_time]" id="shipping_time_interval" onchange="OrderIssueForm.formUpdated('shipping_time');">
                            <option value="4" >00:00 - 08:00</option>
                            <option value="1" selected>08:00 - 14:00</option>
                            <option value="2" >14:00 - 18:00</option>
                            <option value="3" >18:00 - 24:00</option>
                            <option value="exact"  >Precīzs laika diapazons (+7Ls)</option>
                        </select>
                    </td>
                </tr>
                <tr  style="display:;" id="shipping_exact_time_tr">
                    <td class="first">Precīzs diapazons</td>
                    <td>
                        <span>no:</span>
                        <span>
                            <select class="form-select" name="order[exact_interval_from_h]" id="exact_interval_from_h" onchange="OrderIssueForm.formUpdated('exact_interval_from_h');">
                                <option value="7" selected>07</option>
                                <option value="8" >08</option>
                                <option value="9" >09</option>
                                <option value="10" >10</option>
                                <option value="11" >11</option>
                                <option value="12" >12</option>
                                <option value="13" >13</option>
                                <option value="14" >14</option>
                                <option value="15" >15</option>
                                <option value="16" >16</option>
                                <option value="17" >17</option>
                                <option value="18" >18</option>
                                <option value="19" >19</option>
                                <option value="20" >20</option>
                                <option value="21" >21</option>
                                <option value="22" >22</option>
                                <option value="23" >23</option>
                            </select>
                        </span>
                        <span>
                            <select class="form-select" name="order[exact_interval_from_m]" id="exact_interval_from_m" onchange="OrderIssueForm.formUpdated('exact_interval_from_m');">
                                <option value="0" selected>00</option>
                                <option value="15" >15</option>
                                <option value="30" >30</option>
                                <option value="45" >45</option>
                            </select>
                        </span>
                        <span>līdz:</span>
                        <span>
                            <select class="form-select" name="order[exact_interval_till_h]" id="exact_interval_till_h" onchange="OrderIssueForm.formUpdated('exact_interval_till_h');">
                                <option value="8" selected>08</option>
                                <option value="9" >09</option>
                                <option value="10" >10</option>
                                <option value="11" >11</option>
                                <option value="12" >12</option>
                                <option value="13" >13</option>
                                <option value="14" >14</option>
                                <option value="15" >15</option>
                                <option value="16" >16</option>
                                <option value="17" >17</option>
                                <option value="18" >18</option>
                                <option value="19" >19</option>
                                <option value="20" >20</option>
                                <option value="21" >21</option>
                                <option value="22" >22</option>
                                <option value="23" >23</option>
                                <option value="24" >24</option>
                            </select>
                        </span>
                        <span>
                            <select class="form-select" name="order[exact_interval_till_m]" id="exact_interval_till_m" onchange="OrderIssueForm.formUpdated('exact_interval_till_m');">
                                <option value="0" selected>00</option>
                                <option value="15" >15</option>
                                <option value="30" >30</option>
                                <option value="45" >45</option>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="first">Pilsēta</td>
                    <td>
                        <select size="1" class="form-select" name="order[shipping_city]" id="city_id" onchange="OrderIssueForm.formUpdated('city');">
                            <option value="1" selected>Rīga</option>
                            <option value="7" >Rīga-Vecmīlgrāvis un tālāk</option>
                            <option value="8" >Rīga-Bolderāja un tālāk</option>
                            <option value="2" >Jūrmala no Lielupes līdz Majoriem</option>
                            <option value="3" >Jūrmala no Dubultiem līdz Ķemeriem</option>
                            <option value="4" >Rīgas rajons līdz apvidus ceļam</option>
                            <option value="5" >Rīgas rajons aiz apvidus ceļa</option>
                            <option value="6" >Latvija</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="first">Piegādes cena</td>
                    <td>
                        <strong><span id="thePrice">5.00</span> LVL</strong>
                    </td>
                </tr>
                <tr>
                    <td class="first">Piegādes adrese</td>
                    <td>
                        <select size="1" class="form-select" name="order[shipping_place_type]">
                            <option value='1' selected>dzīvoklis</option>
                            <option value='2' >privātmāja</option>
                            <option value='3' >darba adrese</option>
                            <option value='4' >viesnīca</option>
                            <option value='5' >slimnīca</option>
                            <option value='6' >cits</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="first">Precīza adrese</td>
                    <td><textarea class="form-textarea" name="order[full_address]" cols="30" rows="3"></textarea>
                        <p style="font-size:85%;padding-top:3px;">Norādiet precīzo adresi, firmas nosaukumu, darba laiku, koda atslēgu...</p>
                    </td>
                </tr>
                <tr>
                    <td class="first" style="text-align:right;">3.00LVL <span><input type="checkbox" class="form-checkbox" name="order[clarify_everything]" value="1" id="clarify_everything" onclick="OrderIssueForm.formUpdated('clarify_everything');" ></span></td><td>Mēs paši noskaidrosim ielu, mājas vai dzīvokļa numuru, firmas nosaukumu vai koda atslēgu.</td>
                </tr>
                <tr>
                    <td class="first" style="text-align:right;"><input type="checkbox" class="form-checkbox" name="order[clarify_address_fr]" value="1" ></td><td>Mēs noskaidrosim adresi, sazinoties ar saņēmēju (šinī gadījumā piegādes laiku nosaka saņēmējs)</td>
                </tr>
            </table>
        </div>
        <div style="margin-top:10px; padding-right:10px;margin-left:150px;">
            <div style="padding-top:8px;"><input type="submit" value="Atgriezties" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="submit" value="Turpināt" name="" style="width: 90px; height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
    </div><br>
</div>