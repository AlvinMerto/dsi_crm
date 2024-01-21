                        <?php
                            if (count($additionalinfo) > 0) {
                                foreach($additionalinfo as $ai) {
                                    echo "<tr>";
                                        echo "<th> <i class='removethis ti ti-trash-x' data-r='{$ai->id}' data-tid='{$ai->item_id}'></i> {$ai->title} </th>";
                                        echo "<th> {$ai->label}</th>";
                                    echo "</tr>";

                                    echo "<tr>";
                                        echo "<td> &nbsp; </td>";
                                        echo "<td> {$ai->description} </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                    echo "<td colspan='2' style='font-style:italic;'> -- no data -- </td>";
                                echo "</tr>";
                            }
                        ?>