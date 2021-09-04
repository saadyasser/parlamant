<x-main-layout title="اضافة عضو جديد">

    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">اسم العضو</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="ادخل اسم العضو">
            </div>
            <div class="form-group">
                <label for="phone_number">رقم الجوال</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="ادخل رقم الجوال">
            </div>
            <div class="form-group">
                <label for="about">حول العضو </label>
                <input type="text" class="form-control" name="about" id="about" placeholder="ادخل بيانات اضافية عن العضو">
            </div>
            <div class="form-group">
                <label for="image">صورة شخصية</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="full_name">الاسم كامل</label>
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="ادخل الاسم كاملا">
            </div>
            <div class="form-group">
                <label for="birthday">تاريخ الميلاد</label>
                <input type="date" class="form-control" name="birthday" id="birthday" placeholder="ادخل تاريخ الميلاد">
            </div>
            <div class="form-group">
                <label for="type">نوع العضو</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="عضو فعال" id="type1">
                    <label class="form-check-label" for="exampleRadios1">
                        فعال
                    </label>
                </div>
                <div class="form-check">
                    <input i class="form-check-input" type="radio" name="type" value="عضو مجلس" id="type2">
                    <label class="form-check-label" for="exampleRadios2">
                        مجلس
                    </label>
                </div>
                <div class="form-check">
                    <input i class="form-check-input" type="radio" name="type" value="أدمن" id="type3">
                    <label class="form-check-label">
                        أدمن
                    </label>
                </div>
            </div>
            <div class="form-group" id="council">
                <label for="name">اختر المجلس</label>
                <select name="parent_id" class="form-control">
                    @foreach($councils as $key => $value)
                    <option class="form-group" value={{$key}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="marital_status">الحالة الاجتماعية</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="marital_status" value="أعزب" id="exampleRadios1">
                    <label class="form-check-label" for="exampleRadios1">
                        أعزب
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="marital_status" value="متزوج" id="exampleRadios2">
                    <label class="form-check-label" for="exampleRadios2">
                        متزوج
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="email">البريد الالكتروني</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="ادخل البريد الالكتروني">
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="ادخل كلمة المرور ">
            </div>

            <button type="submit" class="btn btn-primary">تسجيل عضو</button>
        </form>
    </div>

</x-main-layout>