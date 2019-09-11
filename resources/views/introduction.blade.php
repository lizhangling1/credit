@extends('common')

@section('css')
    <link rel="stylesheet" href="/css/step.css"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Dear,Sir/Mdm</h2>
            <p class="text-center small">Get the loan you need with Lending Bee,you will need approximatly 5-10 minitues
                to complete the loan application process.</p>
        </div>
    </div>

    <div class="row intro-flow">
        <div class="intro-list">
            <div class="intro-list-left"> Loan Application</div>
            <div class="intro-list-right">
                <span>1</span>
                <div class="intro-list-content"> Select your loan purpose and the loan amount your needed.</div>
            </div>
        </div>

        <div class="intro-list">
            <div class="intro-list-left"> My Particulars</div>
            <div class="intro-list-right">
                <span>2</span>
                <div class="intro-list-content"> Log in MyInfo*(Via Sinpass) to retrieve your particulars.</div>
            </div>
        </div>

        <div class="intro-list">
            <div class="intro-list-left"> Enhancement Document</div>
            <div class="intro-list-right">
                <span>3</span>
                <div class="intro-list-content"> Purchase your Credit Report and upload to our platform.</div>
            </div>
        </div>

        <div class="intro-list">
            <div class="intro-list-left"> Loan Application Status</div>
            <div class="intro-list-right">
                <span>4</span>
                <div class="intro-list-content"> Outcome of your loan application.</div>
            </div>
        </div>

        <div class="intro-list">
            <div class="intro-list-left"> Loan Disbursment</div>
            <div class="intro-list-right">
                <span>5</span>
                <div class="intro-list-content"> Sign contract at the selected branch and get the cash instantly.</div>
            </div>
        </div>
    </div>

    <div class="grap"></div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="/loan/process" class="btn btn-block btn-primary">START</a>
        </div>
    </div>

    <div class="grap"></div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 small">
            <p>*MyInfo is a service that enables citizens and residents to manage the use of their personal data for
                simpler online transactions.</p>
            <p>Lending Bee does not store your SingPass login details on our website.</p>
        </div>
    </div>
@endsection
