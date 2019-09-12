@extends('common')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/layui.css"/><!-- 步骤插件css -->
    <link rel="stylesheet" type="text/css" href="/css/fileinput.css"/><!-- 文件上传CSS -->
@endsection

@section('js')
    <script type="text/javascript" src="/js/fileinput.js"></script>
@endsection

@section('myext')
    <div class="row box-timeline">
        <div class="timeline-posi">
            Loan Application
            <div class="box-num box-line-right"> 1</div>
        </div>
        <div class="timeline-posi" data-index="2">
            My Particulars
            <div class="box-num box-line-left box-line-right"> 2</div>
        </div>
        <div class="timeline-posi" data-index="3">
            Enhancement Document
            <div class="box-num box-line-left box-line-right"> 3</div>
        </div>
        <div class="timeline-posi" data-index="4">
            Application Status
            <div class="box-num box-line-left box-line-right"> 4</div>
        </div>
        <div class="timeline-posi" data-index="5">
            Loan Disbursment
            <div class="box-num box-line-left"> 5</div>
        </div>
    </div>
@endsection
@section('content')
    {{--第一步--}}
    <div class="step" style="display: none">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <select class="form-control" name="reason_loan">
                    <option value="0">Select the reason for your Loan</option>
                    @foreach($selections['reasonforloan'] as $item)
                        <option value="{{ $item }}">{{ $item}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <p>Attach the supporting documents if there is any. </p>
                    <input id="support" name="support" type="file">
                    <div id="support-errors" class="file-error"></div>
                    <script type="text/javascript">//自动上传 支持文件
                        $("#support").fileinput({
                            uploadUrl: '/file/update',
                            maxFileCount: 1,
                            uploadAsync: true,
                            dropZoneEnabled: false,
                            showPreview: false,
                            showRemove: true,
                            showUpload: false,
                            elErrorContainer: '#support-errors',
                            enctype: 'multipart/form-data',
                            allowedFileExtensions: ['pdf', 'doc', 'docx', 'xlsx', 'txt', 'png', 'jpeg', 'jpg'],
                            msgInvalidFileExtension: "Invalid extension for file '{name}'. Only '{extensions}' files are supported.",
                            uploadExtraData: {
                                _token: "{{ csrf_token() }}"
                            },
                        }).on("filebatchselected", function (event, files) {
                            $(this).fileinput("upload");
                        }).on("fileuploaded", function (event, data) {
                            alert(1);
                            console.log(data);
                        });
                    </script>

                    <p style="padding-top: 5px;">Add one or more attachments. &nbsp;
                        <i onclick="showAttachment(this)" class="fa fa-plus auxiliary-color" aria-hidden="true"></i>
                    </p>
                    <div style="display: none" id="i_show">
                        <input id="attachments" name="attachments" type="file"/>
                        <div id="attachments-errors" class="file-error"></div>
                    </div>
                    <script type="text/javascript">//自动上传 支持文件
                        $("#attachments").fileinput({
                            uploadUrl: '/file/update',
                            maxFileCount: 1,
                            dropZoneEnabled: false,
                            showPreview: false,
                            showRemove: false,
                            showUpload: false,
                            elErrorContainer: '#attachments-errors',
                            nctype: 'multipart/form-data',
                            allowedFileExtensions: ['pdf', 'doc', 'docx', 'xlsx', 'txt', 'png', 'jpeg', 'jpg'],
                            msgInvalidFileExtension: "Invalid extension for file '{name}'. Only '{extensions}' files are supported.",
                            uploadExtraData: {
                                _token: "{{ csrf_token() }}"
                            },
                        }).on("filebatchselected", function (event, files) {
                            $(this).fileinput("upload");
                        }).on("fileuploaded", function (event, data) {
                            alert(1);
                            console.log(data);
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="input-group">
                    <div class="input-group-addon">S$</div>
                    <input type="number" class="form-control" name="amount_loan"
                           placeholder="Key in your preferred loan amount(e.g. 1000)">
                </div>
            </div>
        </div>

        <div class="grap"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p>Log in MyInfo,the system will retrieve your particulars from MyInfo portal.</p>
                <p>Simply prepare the following details for MyInfo login:</p>
                <ol style="list-style: disc">
                    <li>SingPass ID and Password to login to your SingPass account.</li>
                    <li>For Two-Factor Authentication,a generated One-Time Password(OTP) send via SMS or through a
                        OneKey token.
                    </li>
                </ol>
                <p> Lending Bee does not store your SingPass Login Details on our website. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="agree" value="1" checked/>
                        I agree to share my information with Lending Bee.
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block" onclick="step0(0)">APPLY VIA MYINFO</button>
            </div>
        </div>
    </div>
    {{--第二步--}}
    <div class="step" style="display: none">
        <div class="row">
            <div class="col-md-12">
                <p> Kindly verify that the system has accurately captured your personal particulars.Please fill in the
                    remaining mandatory fields </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Marital Status</label>
                    <select class="form-control">
                        @foreach($selections['marital'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Name of Company</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Industry</label>
                    <select class="form-control">
                        <option value="0">Construction & Engineering</option>
                        @foreach($selections['industry'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Residential Ownership</label>
                    <select class="form-control">
                        @foreach($selections['residential'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Employment Status</label>
                    <select class="form-control">
                        @foreach($selections['employment'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Years & Months with Current Company</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" maxlength="4" class="form-control" placeholder="Years">
                        </div>
                        <div class="col-md-6">
                            <input type="number" maxlength="2" class="form-control" placeholder="Months">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Occupation</label>
                    <select class="form-control">
                        @foreach($selections['occupation'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Years & Months of Residence</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" maxlength="4" class="form-control" placeholder="Years">
                        </div>
                        <div class="col-md-6">
                            <input type="number" maxlength="4" class="form-control" placeholder="Months">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1default" data-toggle="tab">Personal Particulars</a></li>
                        <li><a href="#tab2default" data-toggle="tab">Contact Details</a></li>
                        <li><a href="#tab3default" data-toggle="tab">Income</a></li>
                        <li><a href="#tab4default" data-toggle="tab">Other</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full Name(per NRIC)</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>NRIC</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country of Birth</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Race</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Residential Status</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number as in SingPass</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Home Number</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Registered Address</label>
                                            <input type="text" class="form-control"
                                                   placeholder="House no. and street address" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Apartment/Condo Name"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Unit No" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Postal Code" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Type of Housing/HDB"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Type of HDB Dwelling"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Number of owner</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>I stay at a different address (Optional)</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3default">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Year of Assessment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Year of Assessment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Employment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Employment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Trade</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Trade</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Rent</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Rent</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Interest</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Interest</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Assessable Income</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-4 text-right">
                                                <label style="line-height: 37px">Assessable Income</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tax Category</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tax Category</label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab4default">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Highest Education Level</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Ownership of Private Residential Property </label>
                                            <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" onclick="showCpf()">
                <h2>Employer CPF Contributions &nbsp;
                    <i class="fa fa-sort" aria-hidden="true"></i>
                </h2>
            </div>
        </div>
        <div class="row" id="cpf" style="display: none">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>For Month</th>
                        <th>Paid on</th>
                        <th>Amount</th>
                        <th>Employer</th>
                    </tr>
                    <tr>
                        <td>Employer CPF Contributions</td>
                        <td>Employer CPF Contributions</td>
                        <td>Employer CPF Contributions</td>
                        <td>Employer CPF Contributions</td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            function showCpf() {
                if ($("#cpf").is(":hidden")) {
                    $("#cpf").slideDown();
                } else {
                    $("#cpf").slideUp();
                }
            }
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="" checked>
                        I acknowledge that my details above are accurate.
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    Please note that the information provided by you or from your account may be submitted to the
                    Moneylenders Credit Bureau for the purpose of producing the credit report.
                    Such information may be provided by the Bureau to the Registrar and any public agency.
                </p>
                <p>
                    By proceeding with the application,you consent to this disclosure.
                </p>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-4 col-md-offset-2">
                <button type="button" class="btn btn-primary btn-block" onclick="step2()">CONTINUE</button>
            </div>

            <div class="col-md-4">
                <a href="javascript:history.back()" class="btn btn-default btn-block">SAVE & EXIT</a>
            </div>
        </div>
    </div>
    {{--第三步--}}
    <div class="step" style="display: none">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="text-center">Hi {{ $user->name }}!</h2>
                <p>we've received the necessary details provided by MyInfo.The next item required for the application is
                    the Personal Credit Report
                    which can be purchased from the Credit Bureau Singapore(CBS) website.</p>
                <p>This report costs S$6.42 and since Lending Bee requires the report in order to process your loan
                    application,
                    we'll reimburse you S$6.42 for the report regardless of whether your loan is approved or declined.
                </p>
                <p>
                    Using SingPass,sign in to the CBS website and purchase the report.Once done,save a copy of the
                    report
                    and the proceed to upload the report to our platform.
                </p>
            </div>
        </div>
        <div class="grap"></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <a href="https://www.creditbureau.com.sg/buy-my-credit-report.html" target="_blank"
                   class="btn btn-primary">PROCEED TO CREDIT BUREAU
                    SINGAPORE</a>
            </div>
        </div>

        <div class="grap"></div>
        <div class="row">
            <div class="col-md-12">
                <input id="file" name="report" type="file">
            </div>
            <script type="text/javascript">
                //信用报告上传
                $("#file").fileinput({
                    uploadUrl: '/loan/report',
                    uploadExtraData: function (previewId, index) {
                        return {_token: "{{ csrf_token() }}"};
                    },
                }).on("fileuploaded", function (event, data, previewId, index) {
                    if (data.response.code == 200) {
                        layer.confirm('Congratulations on the passing of information certification!', {
                            btn: ['Enter the next step']
                        }, function () {
                            $.get('/loan/next', function (data) {
                                if (data.code == 200) {
                                    location.reload();
                                }
                            })
                        });
                    }
                });
            </script>
        </div>
        <div class="row" style="margin-top: 40px;">
            <div class="col-md-4 col-md-offset-2">
                <a href="javascript:stepPrevious();" class="btn btn-default btn-block"> Previous </a>
            </div>

            <div class="col-md-4">
                <a href="javascript:stepNext();" class="btn btn-primary btn-block"> Next </a>
            </div>
        </div>
    </div>
    {{--第四步--}}
    <div class="step" style="display: none">
        <div class="row">
            <h2 class="text-center">Please go offline to do identification</h2>
        </div>
    </div>
    {{--第五步--}}
    <div class="step" style="display: none">
        <div class="row">
            <h2 class="text-center">Withdraw money</h2>
        </div>
    </div>

    <script type="text/javascript">
        //当前处理到了第几步
        var stepBox = $(".step"),
            step = "{{ $step }}",
            timeline = $(".timeline-posi"),
            timeline_div = timeline.eq(step).find('div');

        stepBox.eq(step).show();

        //进度线
        timeline.eq(step).addClass('box-num-active');
        var timeline_dev_class = timeline_div.attr('class');
        var timeline_dev_arr = timeline_dev_class.trim().split(" ")
        timeline_dev_class = timeline_dev_arr[0] + ' ' + timeline_dev_arr[1] + "-active " + timeline_dev_arr[2] + '-active';
        timeline_div.attr('class', timeline_dev_class);


        function step0(step) {
            var stepcontainer = stepBox.eq(step);

            var reason = stepcontainer.find("select[name=reason_loan]").val();
            var amount = stepcontainer.find("input[name=amount_loan]").val();

            if (reason == 0 | amount == '') {
                layer.confirm('Choose a loan reason or Fill in the loan amount', {
                    btn: ['ok']
                });
                return false;
            }

            $.post('/loan/create', {
                '_token': "{{ csrf_token() }}",
                'reason': reason,
                'amount': amount,
            }, function (res) {
                if (res.code == 200) {
                    location.href = "/loan/affirm"; //;
                } else {
                    layer.confirm(res.msg, {
                        btn: ['ok']
                    });
                }
            });
        }

        function step2() {//验证完信息 进入下一步 第三步
            $.get('/loan/next', function (data) {
                if (data.code == 200) {
                    location.reload();
                }
            })
        }

        function stepPrevious() {
            $.get('/loan/pre', function (data) {
                if (data.code == 200) {
                    location.reload();
                }
            })
        }

        function stepNext() { //带提示的下一步
            layer.confirm('Kindly upload your CBS report to proceed', {
                btn: ['ok', 'Skip']
            }, function (index) {
                layer.close(index)
            }, function () {
                $.get('/loan/next', function (data) {
                    if (data.code == 200) {
                        location.reload();
                    }
                })
            });
        }


        //显示上传附件的input
        function showAttachment(_that) {
            if ($("#i_show").is(':visible')) {
                $("#i_show").slideUp();
                $(_that).removeClass('fa-minus');
                $(_that).addClass('fa-plus');
            } else {
                $("#i_show").slideDown();
                $(_that).removeClass('fa-plus');
                $(_that).addClass('fa-minus');
            }
        }
    </script>
@endsection
