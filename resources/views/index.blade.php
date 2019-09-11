@extends('common')

@section('content')
    <div class="grap"></div>
    @if(!empty($user) && $user->is_loan)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table">
                    <thead>
                    <tr>
                        <th> Loan no.</th>
                        <th> Status</th>
                        <th> Schedule</th>
                        <th> Date of Application</th>
                        <th> Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tr>
                        <td>{{ $loan->loanNo }}</td>
                        <td>{{ $loan->status() }}</td>
                        <td>{{ ($loan->step*20)."%" }}</td>
                        <td>{{ $loan->created_at }}</td>
                        <td><i class="fa fa-usd" aria-hidden="true"></i> &nbsp;{{ $loan->amount }}</td>
                        <td>
                            <a class="continue" href="/loan/process" role="button">CONTINUE</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p>Here is introduction for Lending Bee.</p>
                <p>
                    Just like bees who are hardworking and have a strong sense of colony culture in terms of teamwork and trust, we’re constantly pushing boundaries. Since 2005, we’ve been committed to transforming and streamlining the way in which people access credit. We believe that access to credit should be kept fuss free and attainable, therefore we’ve helped thousands of Singaporeans build their credit, grow their business and achieve financial freedom.
                </p>
            </div>

            <div class="col-md-6 col-md-offset-3" style="margin-top: 20px;">
                <a class="btn btn-primary btn-block" href="/loan/introduce" role="button">APPLY FOR A LOAN</a>
            </div>
        </div>
    @endif
@endsection
