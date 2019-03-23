@extends('main')
@section('content')
        <!-- Breadcrumbs-->
      @if($pid)
        @foreach($pat as $pats)
          @if($pats->department_id != Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
            @foreach($transfers as $trans)
              @if($trans->status == "")
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id)}}" class="btn btn-primary" style="margin-left:550px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
        </ol>
              @elseif(Auth::user()->department == $pats->department_id || Auth::user()->user_role->first()->name == 'Superadmin')
          <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
    
        </ol>
            @endif
            @endforeach

          @include('flash::message')
        <!-- Icon Cards-->
        <div class="container">
         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Name:</h5> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date of Birth:</h5> {{$pats->birthdate}}</p>
              </div>
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Address:</h5> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Marital Status:</h5> {{$pats->civil_status}}</p>
              </div>
              <div class="col-md-1">
                <p style="font-size: 15px"><h5>Age:</h5> {{$pats->age}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date Admitted:</h5> {{$pats->created_at}}</p>
              </div>
           </div>
           <div class="row">
          @if($pats->birthorder != NULL)
            @if($pats->birthorder != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Birth Order:</h5> {{$pats->birthorder}}</p>
              </div>
            @endif
            @if($pats->contact != 'NULL')
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Contact Number:</h5> {{$pats->contact}}</p>
              </div>
            @endif
            @if($pats->nationality != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Nationality:</h5> {{$pats->nationality}}</p>
              </div>
            @endif
            @if($pats->religion != 'NULL')
              <div class="col-md-2"> 
                <p style="font-size: 15px"><h5>Religion:</h5> {{$pats->religion}}</p>
              </div>
            @endif
          @endif
           </div>
          </div>
          </fieldset>
          <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Transfer Remarks</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
            @foreach($transfer as $trans)
              <p style="margin-left: 30px">{{$trans->remarks}}</p>
            @endforeach
           </div>
           <div class="row">
          
           </div>
          </div>
          </fieldset>
        </div>
            
        @else
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
        <div class="container">
         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Name:</h5> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date of Birth:</h5> {{$pats->birthdate}}</p>
              </div>
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Address:</h5> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Marital Status:</h5> {{$pats->civil_status}}</p>
              </div>
              <div class="col-md-1">
                <p style="font-size: 15px"><h5>Age:</h5> {{$pats->age}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date Admitted:</h5> {{$pats->created_at}}</p>
              </div>
           </div>
           <div class="row">
          @if($pats->birthorder != NULL)
            @if($pats->birthorder != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Birth Order:</h5> {{$pats->birthorder}}</p>
              </div>
            @endif
            @if($pats->contact != 'NULL')
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Contact Number:</h5> {{$pats->contact}}</p>
              </div>
            @endif
            @if($pats->nationality != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Nationality:</h5> {{$pats->nationality}}</p>
              </div>
            @endif
            @if($pats->religion != 'NULL')
              <div class="col-md-2"> 
                <p style="font-size: 15px"><h5>Religion:</h5> {{$pats->religion}}</p>
              </div>
            @endif
          @endif
           </div>
          </div>
          </fieldset>
          <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
          <div class="container" style="margin-left: 10px">
           <div class="row">
  
           </div>
          </div>
          </fieldset>
        </div>
          @endif
        @endforeach
      @else
        @foreach($pat as $pats)
          @if($pats->department_id == Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
        </ol>

        

          @include('flash::message')
        <!-- Icon Cards-->
          <div class="row" style="margin-left: 10px;">
            <div style="border-right:solid black 1px;width: 250px">
            <div class="col-md-11" style="text-align: center;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 10px"><h6>Information</h6></a>
                <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 10px"><h6>Refer</h6></a>
                <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 10px"><h6>Sessions</h6></a>
                <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 10px"><h6>History</h6></a>
              </div>
            </div>
          </div>
            <div class="col-md-9">
              <div class="tab-content" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-2">
                          <p style="font-size: 8px"><h6>Name:</h6> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
                         </div>
                       <div class="col-md-2">
                          <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                       </div>
                      <div class="col-md-4">
                        <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-2">
                       <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                      </div>
                      <div class="col-md-1">
                         <p style="font-size: 8px"><h6>Age:</h6> {{$pats->age}}</p>
                      </div>
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Date Admitted:</h6> {{$pats->created_at}}</p>
                      </div>
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-2">
                        <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-2">
                      <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-2"> 
                     <p style="font-size: 8px"><h6>Religion:</h6> {{$pats->religion}}</p>
                  </div>
                 @endif
                @endif
                  </div>
                </fieldset>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                  </fieldset>
                </div>
              </div>
            </div>
          </div>
        
          @endif
        @endforeach
      @endif
  
@endsection