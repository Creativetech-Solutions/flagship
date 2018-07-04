<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */



?>

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <?php if ($user->levelCheck("9,7,6,1")) : ?>
                    <!-- DESTINATIOIN -->
                    <li style="margin-top: 10px; margin-left: 15px;">
                        <form>
                            <select id="destination_select" class="form-control">
                                <option value="" selected>ANU - Antigua</option>
                                <option value="<?php echo $uri; ?>bumblebee-fll/">FLL - Florida</option>
                                <option value="<?php echo $uri; ?>bumblebee-bgi/">BGI - Barbados</option>
                                <option value="<?php echo $uri; ?>bumblebee-gnd/">GND - Grenada</option>
                                <option value="<?php echo $uri; ?>bumblebee-skb/">SKB - St.Kitts & Nevis</option>
                            </select>
                            <script>
                                $(function(){
                                    $('#destination_select').bind('change', function () {
                                        var url = $(this).val(); // get selected value
                                        if (url) { // require a URL
                                        window.location = url; // redirect
                                    }
                                return false;
                                    });
                                });
                            </script>
                        </form>
                    </li>   
                    <!-- END DESTINATION -->
                    <?php else: ?>
                        <li hidden></li>
                    <?php endif; ?>
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right" style="margin-right: 35px;">
                        <a href="#" class="mb-control" data-box="#mb-signout"> <span class="fa fa-sign-out"><strong>Logout</strong></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->
