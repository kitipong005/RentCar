<div class="row justify-content-center mt-5">
    <div class="col-10">
        <div class="row mb-3">
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-search"><i class="fa fa-search"></i></span>
                    </div>
                    <select name="choose" class="form-control text-white bg-search">
                        <option value="0">ค้นหาจาก:</option>
                        <option value="pos_jobs">ค้นจากตำแหน่งงาน</option>
                        <option value="Note">ค้นจากชื่อบริษัท</option>
                        <option value="สองอย่าง">ค้นจากตำแหน่ง หรือ ชื่อบริษัท</option>
                        <option value="des_jobs">ค้นจากรายละเอียดงาน</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- end row 1 --}}
        <div class="row mb-3">
            <div class="col-6">
                <div class="input-group mb-3" >
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-search"><i class="fa fa-search"></i></span>
                    </div>                   
                            <input value="" type="text" id="Sdate" class="form-control bg-search" autocomplete="off">
                </div>
            </div>
            <div class="col-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-search"><i class="fa fa-search"></i></span>
                        </div>                   
                                <input value="" type="text" id="Edate" class="form-control bg-search" autocomplete="off">
                    </div>
                </div>
        </div>
        {{-- end row 2 --}}
        <div class="row mb-3">
                <div class="col-8 ">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-search"><i class="fa fa-search"></i></span>
                        </div>
                        <select name="choose" class="form-control bg-search">
                            <option value="0">จำนวนที่นั่ง:</option>
                            <option value="pos_jobs">ค้นจากตำแหน่งงาน</option>
                            <option value="Note">ค้นจากชื่อบริษัท</option>
                            <option value="สองอย่าง">ค้นจากตำแหน่ง หรือ ชื่อบริษัท</option>
                            <option value="des_jobs">ค้นจากรายละเอียดงาน</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <button class="btn-primary form-control btn-search">ค้นหา</button>
                </div>
            </div>
            {{-- end row 3 --}}
    </div>
</div>