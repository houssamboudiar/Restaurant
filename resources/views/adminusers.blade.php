@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="container col-lg-12" style="margin-top:20px;">
    <div > 
        <button href="#bottom" id='btn' type="submit" class='btn btn-success' onclick="addRow()" style='margin-bottom: 12px;' ><a href="#bottom" style="text-decoration:none; color:#fff; " >Add dish</a></button>
    </div>
        @if (count($users)>=1)
        <div class="table-responsive-xl" >
            <table id="applyTable" class="table">
                <thead class="thead-light">
                    <tr >
                        <th class="w-auto" scope="col" >#</th>
                        <th class="w-auto" scope="col">First name</th>
                        <th class="w-auto" scope="col">Last name</th>
                        <th class="w-auto" scope="col">Type</th>
                        <th class="w-auto" scope="col">Email</th>
                        <th class="w-auto" scope="col">Delete</th>
                        <th class="w-auto" scope="col">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $userr)
                    <tr >
                        <th  class="w-auto" style="text-transform:capitalize;">{{$userr->id}}</th>
                        <th  class="w-auto"style="text-transform:capitalize;">{{$userr->fname}}</th>
                        <td class="w-auto" style="text-transform:capitalize;">{{$userr->lname}}</td>
                        <td class="w-auto" style="text-transform:capitalize;">{{$userr->user_type}}</td>
                        <td class="w-auto" style="text-transform:capitalize;">{{$userr->email}}</td>

                        <td class="w-auto" >

                            <form action="{{route('deleteuser',[$userr->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-danger' >Delete</button>
                            </form>

                        </td>

                        <td class="w-auto" >
                            <!-- Button trigger modal -->

                            <button id="{{$userr->id}}" type="button" class="btn btn-primary" onclick="getRow(this.id)" data-toggle="modal" data-target="#UpdateUserModl">
                            Update
                            </button>

                            <form id="form2{{$userr->id}}"  action="{{ route('updateuser', [$userr->id]) }}" method="post">
                            @csrf
                            @method('post')                         
                            <div style="margin-top: 10px;" >  
                            <input form="form2{{$userr->id}}" hidden required class="form-control" id="fname{{$userr->id}}" type="text" name="fname" placeholder=" First name" />
                            </div>

                            <div style="margin-top: 10px;">
                            <input form="form2{{$userr->id}}" hidden required class="form-control" id="lname{{$userr->id}}" type="text" name="lname" placeholder=" Last name" />
                            </div>

                            <div style="margin-top: 10px;">                          
                            <select form="form2{{$userr->id}}" hidden required class="form-control" id="ctype{{$userr->id}}" name="type" style="text-transform:capitalize;" id="type">
                                    <option selected="selected">client</option>
                                    <option>cuisinier</option>
                                    <option>cashier</option>
                                    <option>server</option>
                                    <option>admin</option>
                            </select>
                            </div>
                            <button id="bttn{{$userr->id}}" style="margin-top:8px;" hidden form="form2{{$userr->id}}" type="submit" class="btn btn-primary">Save changes</button>

                            </form>
                            
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @else
            <h1>No users yet ! :)</h1>
        @endif
        <div id="bottom"><a href="bottom"></a></div>

    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="UpdateUserModal" tabindex="-1" role="dialog" aria-labelledby="UpdateUserModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">UPDATE USER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

                        <div style="margin-top: 10px;" >  
                        <input form="form2" required class="form-control" id="fname" type="text" name="fname" placeholder=" First name" />
                        </div>

                        <div style="margin-top: 10px;">
                        <input form="form2" required class="form-control" id="lname" type="text" name="lname" placeholder=" Last name" />
                        </div>

                        <div style="margin-top: 10px;">                          
                        <select form="form2" required class="form-control" id="ctype" name="type" style="text-transform:capitalize;" id="type">
                                <option selected="selected">client</option>
                                <option>cuisinier</option>
                                <option>cashier</option>
                                <option>server</option>
                                <option>admin</option>
                        </select>
                        </div>
                        <button form="form2" type="submit" class="btn btn-primary">Save changes</button>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button form="form2" type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

        <script type="text/javascript" language="javascript">
        var indexplaceholder = 0;
        var t = document.getElementById('applyTable'),rindex;

        function addRow(){
        var test ='<tr id="newrow" ><td scope="row" class="w-auto"><form id="form1" method="post" action="{{ route("addDish") }}">@csrf #</form></td><td class="w-auto"><input form="form1" required class="form-control" type="text" name="name" placeholder=" Name" /></td><td class="w-auto"><select form="form1" required class="form-control" name="type" style="text-transform:capitalize;" id="type"><option selected="selected"  >Dessert</option><option>Plat</option><option>Entrée</option></select></td><td class="w-auto"><textarea  form="form1" required class="form-control" rows="1" cols="50" type="textarea" name="description" placeholder=" Description" /></td><td class="w-auto"><input form="form1" required class="form-control" type="number" pattern="\d*" name="price" placeholder=" Price" /></td><td class="w-auto"><button form="form1" type="submit" class="btn btn-info">Add</button></td></tr>';
        $("#applyTable").append(test);
        var btn = document.getElementById("btn"); 
        btn.disabled = true;
        }
        
        function enableBtn(){
            var btn = document.getElementById("btn"); 
            btn.disabled = false;
        }


        function getRow(clicked_id){
            var btn = document.getElementById(clicked_id);
            
            //document.getElementById('idd').value = btn.parentElement.parentElement.cells[0].textContent ;
            document.getElementById('fname'+clicked_id).value = btn.parentElement.parentElement.cells[1].textContent  ;
            document.getElementById('lname'+clicked_id).value = btn.parentElement.parentElement.cells[2].textContent ;
            document.getElementById('ctype'+clicked_id).value = btn.parentElement.parentElement.cells[3].textContent ;
            document.getElementById('bttn'+clicked_id).hidden = !document.getElementById('bttn'+clicked_id).hidden ;
            document.getElementById('fname'+clicked_id).hidden = !document.getElementById('fname'+clicked_id).hidden ;
            document.getElementById('lname'+clicked_id).hidden = !document.getElementById('lname'+clicked_id).hidden ;
            document.getElementById('ctype'+clicked_id).hidden = !document.getElementById('ctype'+clicked_id).hidden ;



            //for(var i=1 ; i<= t.rows.length ; i++ ){
                    //t.rows[i].cells[6].children.updatebutton.onclick = function(){
                        //console.log('hey');
                        //document.getElementById('fname').value = t.rows[i].cells[1];
                    //} ;
                //}
                //rIndex = table.rowIndex;
                //document.getElementById('fname').value = t.cells[1];
        }

        </script>

</div>



</tr>


@endsection
