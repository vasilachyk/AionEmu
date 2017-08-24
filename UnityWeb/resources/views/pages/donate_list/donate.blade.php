@extends('app')
@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 margin-bottom-sm-30">
                <h3 style="color : #fcfcfc;">Donate List</h3>
                <p>List Donasi Akan Berubah Sewaktu-waktu.</p>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headingOne">
                            <h4 class="panel-title">
                                <a href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                                    DONATE PER ITEMS
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
							    <label class="btn btn-info btn-block">Paket Enchant</label>
                                <p style="color: #0c0d0e; font-size: 16px; font-weight: bold; margin-top: 5px;">&nrightarrow; Enchant Items</p>
                                    &longrightarrow; Enchan Armor 1 set +30 Bonus AP boost 10 dan drana cofe 150 = Rp 75.000 <br>
                                    &longrightarrow; Enchan Acc 1 set + 5 Bonus AP boost 10 dan drana cofe 150 = Rp 75.000 <br>
                                    &longrightarrow; Enchan Weapon +30 Bonus AP boost 10 dan drana cofe 200 = Rp 90.000 <br>
                                    &longrightarrow; Paket hemat Enchan armor 1set +30, acc 1 st +5 dan Weapon +30 Bonus AP boost 40, drana cofe 600 + baju wedding 1 = Rp 200.000 <br>
                                </p>
                         
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

@endsection