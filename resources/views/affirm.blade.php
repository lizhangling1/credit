@extends('common')

@section('content')
    <div class="row text-center">
        <div class="col-md-8 col-md-offset-2">
            <img src="/img/intro-logo.png" width="20%"/>
        </div>
    </div>
    <div class="grap"></div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>Myinfo retrieves personal data from relevant government agencies to pre-fill the relevant fields,
                making digital transactions faster and more convenient.</p>
            <p>
                This digital service is requesting the following information from Myinfo,for the purpose of loan.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> NRIC/FIN</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Name</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Sex</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Race</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Nationality</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Date of Birth</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Country of Birth</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Home Number</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Mobile Number</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Marital Status</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Residential Status</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Registered Address</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Housing Type</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> HDB Type</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Type of HDB Dwelling</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Number of owner</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Mailing address</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Ownership of Private Property Status</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Employer CPE Contributions</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Past 2 year Assessable Income</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Year of Assessment</h5>
            <h5><i class="fa fa-caret-right" aria-hidden="true"></i> Highest Education Level</h5>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-8 col-md-offset-2">
            <p>
                Clicking the "I Agress" button permits this digital service to retrieve your data based on
                the Terms of Use.
            </p>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <a href="/loan/process" class="btn btn-primary btn-block">I Agree</a>
                </div>

                <div class="col-md-4">
                    <a href="/loan/introduce" class="btn btn-default btn-block">No Thanks</a>
                </div>
            </div>
        </div>
    </div>
@endsection
