<html>
    <head>
        <title> Print Preview Quotation </title>

        <style>
            #thebody {
                width: 70%;
                margin: auto;
            }

            #printbtn {
                padding: 8px 16px;background: #fff;border: 1px solid #bbb;border-radius: 4px; box-shadow:0px 3px 10px #b6b6b6;
            }

            #printbtn:hover {
                cursor:pointer;
                background:#ccc
            }

            @media print {
                #thebody {
                    width: 100%;
                    margin: auto;
                }
            }
        </style>
    </head>
<body>
    <div id="thebody">
        <button onClick="printprv('printhere')" id='printbtn'> Print </button>
        <div id='printhere'>
            <?php
                echo $html;
            ?>
        </div>
    </div>

    <script>
                
        function printprv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
    </script>
</body>
</html>