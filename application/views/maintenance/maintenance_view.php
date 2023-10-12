<?php
$getting_maintenance = $this->maintenance_model->Get(['', 2]);
$id_maintenance = '';
if (!empty($getting_maintenance)) {
    foreach ($getting_maintenance as $key) {
        $id_maintenance = $key->id_downtime;
    }
}

?>
<style>
    @import url(http://fonts.googleapis.com/css?family=Roboto);

    * {
        font-family: 'Roboto', sans-serif;
    }

    .content-wrapper {
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);
    }

    .error-template {
        padding: 10% 15%;
        text-align: center;
    }

    .error-actions {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .error-actions .btn {
        margin-right: 10px;
    }

    .message-box h1 {
        color: #252932;
        font-size: 98px;
        font-weight: 700;
        line-height: 98px;
        text-shadow: rgba(61, 61, 61, 0.3) 1px 1px, rgba(61, 61, 61, 0.2) 2px 2px, rgba(61, 61, 61, 0.3) 3px 3px;
    }
</style>

<div class="content-wrapper">
    <?php if ($this->session->userdata('member_id') == 'System') : ?>
        <div class="col-md-12 float-right">
            <button class="btn btn-success btn-xs" id="btnSelect" data-adman="<?= $id_maintenance ?>" data-toggle="modal" data-target="#modal-downtime-update"> Activating </button>
        </div>
    <?php
    endif;
    ?>
    <div class="row" style="margin-left: 100px;">
        <div class="col-md-6">
            <div class="error-template">
                <h1>
                    :) Oops!</h1>
                <h2>
                    Temporarily down for maintenance</h2>
                <h1>
                    We’ll be back soon!</h1>
                <div>
                    <p>
                        Sorry for the inconvenience but we’re performing some maintenance at the moment.
                        we’ll be back online shortly!</p>
                    <p>
                        — The Team</p>
                </div>
                <div class="error-actions">
                    <a href="../../home" style="margin-top: 10px;" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-home">
                        </span>Take Me Home </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <svg class="svg-box" width="380px" height="500px" viewbox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#3bafda" stroke-width="6" sketch:type="MSShapeGroup"></path>
                    <path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#7266ba" stroke-width="6" sketch:type="MSShapeGroup"></path>
                    <path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#f76397" stroke-width="6" sketch:type="MSShapeGroup"></path>
                    <path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#00b19d" stroke-width="6" sketch:type="MSShapeGroup"></path>
                    <path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#ffaa00" stroke-width="6" sketch:type="MSShapeGroup"></path>
                </g>
            </svg>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-downtime-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="access_update">Code</label>
                            <input type="password" class="form-control" id="reason_maintenance_update" placeholder="Enter your code...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnSubmitUpdate" class="btn btn-primary" value="Submit" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#btnSelect", function() {
        var maintenance_id = $(this).data("adman");
        $("#maintenance_id").val(maintenance_id);
    });

    $(document).on('click', '#btnSubmitUpdate', function() {
        var maintenanceID = '<?= $id_maintenance ?>';

        $.ajax({
            url: '<?= base_url(); ?>updateDowntime',
            type: 'POST',
            data: {
                downtime_id: maintenanceID,
                status_down: 0,
                flag: 1
            },
            success: function(response) {
                $('#modal-downtime-update').modal('hide');
                Swal.fire({
                    icon: response.status,
                    title: response.title,
                    text: response.message,
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: toast => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                });
            }
        })
    })
</script>