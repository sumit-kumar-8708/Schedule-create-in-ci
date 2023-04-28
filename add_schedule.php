<style>
    .app-main .app-main__inner {
        padding: 10px 30px 0;
    }

    .dashboard_card {
        margin-bottom: 25px;
    }

    .course_header {
        margin-bottom: 10px;
    }

    .add_btn_div {
        text-transform: capitalize;
        margin-bottom: 20px;
    }

    .save_btn {
        color: #fff !important;
    }
</style>
<style type="text/css">
    input{
        border:none;
    }
    .input_border{
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
    }
    .form-select{
        padding: 7px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    
    .owl-carousel .owl-nav button {
        height: 30px!important;
        width: 30px!important;
        border-radius: 20px!important;
        display: flex!important;
        align-items: center!important;
        justify-content: center!important;
        background-color: #fff!important;
        border: 0px solid #fff!important;
        box-shadow: 0px 4px 4px rgb(0 98 182 / 16%);
    }
    .owl-carousel .owl-nav {
        display: flex !important;
        margin-top: 10px !important;
        margin-bottom: 10px;
        text-align: center !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: bold;
        font-size: 30px;
    }
    .owl-nav button{
        margin:10px;
    }
    .owl-dots{
        display:none;
    }
    .owl-nav span{
        height: 50px;
    }

    .month_name{
        font-size: 12px;
        color: #249e9a;
        font-weight: bold;
    }
    .month_row{
        display: flex;
        justify-content: space-between;
    }
    .month_row h6{
        font-size: 14px;
    }
    .active_date_box{
        background:#37C69F;
        border-radius: 10px;
        color: #000;
    }
    .active_date_box .month_name{
        color: #000;
    }
    .day_checkbox_wrapper{
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        height: fit-content;
    }
    .card_saddow{
        box-shadow: 0px 0px 5px 0px #7a7a7a;;
    }
    .mentor_name{
        background: #c7c7c7;
        color: #000;
        padding: 10px;
        font-weight: bold;
        border-radius: 5px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>


<div class="col-md-10 mt-3">
    <div class=" ">
        <div class="h_text_breadcrumb">
            <section class="course_header">
                <h4><b>Add Schedule :</b></h4>
            </section>
            <section class="navigation_bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url()?>schedule/view_schedule/<?=$mentor_id?>"><i class="fa fa-bars"></i> Schedule List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Schedule</li>
                    </ol>
                </nav>
            </section>
        </div>
      
        <div class="">
            <div class="col-md-12 card " style="
                padding: 10px; border: 3px solid #7d7d7d;">
                <section>
                    <? if ($this->session->flashdata('message')) :  ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('message') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <? elseif ($this->session->flashdata('msg')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('msg') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <? endif; ?>
                    <div>
                        <!-- <h6 class="mentor_name">Mentor Name : <?=$mentor_details->name." ".$mentor_details->last_name?></h6> -->
                        <form class="mt-4" action="<?=base_url()?>course/add_schedule" method="post">
                            <div style="
                                display: flex;
                                gap: 10px;
                                margin-bottom: 15px;
                            " >                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card_saddow p-4">
                                        <label for="date" class="formbold-form-label"> <b>Start Date</b> </label>
                                        <input type="date" name="start_date" id="start_date" class="formbold-form-input input_border" value="<?=$post_data['start_date']?>" min="<?=date('Y-m-d')?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card_saddow p-4">
                                        <label for="date" class="formbold-form-label"> <b>End Date</b> </label>
                                        <input type="date" name="end_date" id="end_date" class="formbold-form-input input_border" value="<?=$post_data['end_date']?>" min="<?=date('Y-m-d')?>" required/>
                                    </div>
                                </div>   
                                <div class="col-md-4" style="
                                    display: flex;
                                    justify-content: center;
                                    flex-direction: column;
                                ">
                                <label for="" class="text-danger"><b>Exclude Days:</b> </label>
                                    <div class="day_checkbox_wrapper">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="mon" value="mon">
                                            <label class="form-check-label mr-2" for="mon">
                                                Mon
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Tue" value="tue">
                                            <label class="form-check-label mr-2" for="Tue">
                                                Tue
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Wed" value="wed">
                                            <label class="form-check-label mr-2" for="Wed">
                                                Wed
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Thi" value="thi">
                                            <label class="form-check-label mr-2" for="Thi">
                                                Thi
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Fri" value="fri">
                                            <label class="form-check-label mr-2" for="Fri">
                                                Fri
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Sat" value="sat">
                                            <label class="form-check-label mr-2" for="Sat">
                                                Sat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exclude_days[]" id="Sun" value="sun">
                                            <label class="form-check-label mr-2" for="Sun">
                                                Sun
                                            </label>
                                        </div>
                                    </div>
                                </div>                                                              
                            </div>
                            <div id="extra__start_end_time" class="mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card_saddow p-4">
                                            <label for="start_time" class="formbold-form-label"> <b>From Time</b> </label>
                                            <input type="time" name="start_time" id="start_time" class="formbold-form-input input_border" value="<?=$post_data['start_time']?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card_saddow p-4">
                                            <label for="end_time" class="formbold-form-label"> <b>End Time</b> </label>
                                            <input type="time" name="end_time" id="end_time" class="formbold-form-input input_border" 
                                            value="<?=$post_data['end_time']?>" required  />
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <div class="row mt-3" id="courseBox">
                                    <div class="col-md-4">
                                        <div class="">
                                            <label for="end_time" class="formbold-form-label"> <b>Select Course</b> <small class="text-danger">(Click on course to select)</small></label>
                                            <select name="course_id" id="courseList" class="form-control">
                                                <option value="" selected disabled>---Select Course---</option>
                                                <?foreach ($courses as $key => $course):?>
                                                    <option value="<?=$course->id?>"><?=$course->title?></option>
                                                <?endforeach;?>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" value="<?=$mentor_details->user_id?>" name="mentor_id">
                                <table class="table table-light table-bordered mt-3">
                                    <tbody id="availabilityTable">
                                        
                                    </tbody>
                                </table>                             
                            <div class="text-center m-4">
                                <!-- <button type="submit" class="btn save_btn" id="availbility"><i class="fa fa-check pr-1" ></i>Check Availbility</button> -->
                                <button type="submit" class="btn save_btn" id="add_schedule"><i class="fa fa-plus pr-1" ></i> Add Schedule</button>
                            </div>
                        </form>
                        
                    </div>             
                </section>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // $('#courseBox').hide();
    // $('#availbility').hide();

    // $('input[type=radio][name=scheduleType]').change(function() {
    //     console.log(this.value);
    //     if (this.value ==2) {
    //         $('#courseBox').show('1');
    //         $('#availbility').show();
    //         $('#add_schedule').hide();
    //         $('#add_more').hide();
    //         $('#courseList').attr('required',true);
    //     }
    //     else{
    //         $('#add_schedule').show();   
    //         $('#availbility').hide();
    //         $('#courseBox').hide('1');
    //         $('#add_more').show();
    //         $('#courseList').removeAttr('required')
    //     }
    // });

//    $(document).ready(function(){
//     $(document).on('click','#availbility',function(e){
//         e.preventDefault();
//        var start_date=$('#start_date').val();
//        var end_date=$('#end_date').val();
//        var start_time=$('#start_time').val();
//        var end_time=$('#end_time').val();
//        if(!(start_date && end_date && start_time && end_time)){
//         alert('Start date time and End date time fields required')
//         return false;
//        }
//         $.ajax({
//             url:"<?=base_url()?>schedule/check_availbility",
//             type:"post",
//             data: $('form').serialize(),
//             success:function(data){
//                 // console.log(data)
//                 data=(JSON.parse(data));
//                 // console.log(data.status);
//                 if(data.status){
//                     let html='';
//                     let bookeDateTime=null; 
//                     bookeDateTime=data.totalBooked;
//                     // console.log(bookeDateTime);
//                     if(bookeDateTime.length>0){
//                         html+=`
//                             <tr>
//                             <td colspan="3" class="text-danger">Your Appointment for this slot is already booked or slot already created as Class. Please find the details.kindly Choose another time slot and try again.</td>
//                             </tr>
//                             <tr>
//                                 <td><b>Start Date Time</b></td>
//                                 <td><b>End Date Time</b></td>
//                                 <td><b>Type (Student Name & Email)</b></td>
//                             </tr>
//                             `;
//                         for (let index = 0; index < bookeDateTime.length; index++) {
//                             const booked = bookeDateTime[index];
//                             let bookname='';
//                             if(booked.type==='1'){
//                                 bookname= `Session - ${booked.name} ${booked.last_name} (${booked.email})`;
//                             }else{
//                                 bookname="Class";
//                             }
//                             html+=`
//                             <tr>
//                                 <td>${booked.start_date_time}</td>
//                                 <td>${booked.end_date_time}</td>                                
//                                 <td>${bookname}</td>                                
                                                           
//                             </tr>
//                             `;
//                         }
//                     }

//                     let list=null;
//                     list=data.scheduleList;
//                     // console.log(list)
//                     if(list.length>0){
//                         html+=`
//                             <tr>
//                                 <td colspan="3" class="text-danger">The appointment for this time slot is created but not booked. You can delete the present slot or choose another time for class.</td>
//                             </tr>
//                             <tr>
//                                 <td><b>Schedule Id</b></td>
//                                 <td><b>Start Date Time</b></td>
//                                 <td><b>End Date Time</b></td>
//                             </tr>
//                             `;
//                         for (let index = 0; index < list.length; index++) {
//                             const li = list[index];
//                             html+=`
//                             <tr>
//                                 <td>${li.id}</td>
//                                 <td>${li.start_date_time}</td>
//                                 <td>${li.end_date_time}</td>
//                             </tr>
//                             `;
//                         }
//                     } 
//                     $('#availabilityTable').html(html);                   
//                 }

//                 $('#availbility').hide();
//                 $('#add_schedule').show();                
//             } 
//         })
//     })
//    })
</script>


