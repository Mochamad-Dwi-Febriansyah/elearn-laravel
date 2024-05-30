  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @php
          $AllChatUserCount = App\Models\ChatModel::getAllChatUserCount();
      @endphp
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('chat') }}">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ !empty($AllChatUserCount) ? $AllChatUserCount : '' }}</span>
        </a> 
      </li> 
    </ul>
  </nav>
  <!-- /.navbar -->


  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link d-flex justify-content-center" style="text-align: center">
      @if (!empty($getHeaderSetting->getLogo()))    
        <img style="width: auto; height: 40px; border-radius: 5px" src="{{ $getHeaderSetting->getLogo() }}" alt="">
        <p style="margin: auto 0; padding: 5px; font-weight: 200">SIBel</p>
      @else
        <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 20px">School</span>
      @endif

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel py-3 d-flex bg-custom-image " style="padding: 0 16px;">
        <div class="image" style="display: flex; justify-content: center; align-items: center">
          <img style="width: 30px; height: 30px;" src="{{ Auth::user()->getProfiledirect()  }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          <p style="margin-bottom: 0; color: #c2c7d0; font-size: 0.8rem">{{ Auth::user()->nis }}</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
          @if(Auth::user()->user_type == 1)
            <li class="nav-item">
              <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/admin/list') }}" class="nav-link  @if(Request::segment(2) == 'admin') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Admin
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin/teacher/list') }}" class="nav-link  @if(Request::segment(2) == 'teacher') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Teacher
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin/student/list') }}" class="nav-link  @if(Request::segment(2) == 'student') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Student
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin/parent/list') }}" class="nav-link  @if(Request::segment(2) == 'parent') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Parent
                </p>
              </a>
            </li> 

            <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Academics
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/class/list') }}" class="nav-link  @if(Request::segment(2) == 'class') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/subject/list') }}" class="nav-link  @if(Request::segment(2) == 'subject') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subject</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/assign_subject/list') }}" class="nav-link  @if(Request::segment(2) == 'assign_subject') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assign Subject</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/class_timetable/list') }}" class="nav-link  @if(Request::segment(2) == 'class_timetable') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class Timetable</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assign Class Teacher</p>
                  </a>
                </li>
              </ul>
            </li> 

            <li class="nav-item @if(Request::segment(2) == 'fees_collection') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Fees Collection
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/fees_collection/collect_fees') }}" class="nav-link  @if(Request::segment(3) == 'collect_fees') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collect Fees</p>
                  </a>
                </li>   
                <li class="nav-item">
                  <a href="{{ url('admin/fees_collection/collect_fees_report') }}" class="nav-link  @if(Request::segment(3) == 'collect_fees_report') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collect Fees Report</p>
                  </a>
                </li>   
              </ul>
            </li> 

            <li class="nav-item @if(Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Examinations
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link  @if(Request::segment(3) == 'exam') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exam</p>
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link  @if(Request::segment(3) == 'exam_schedule') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exam Schedule</p>
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="{{ url('admin/examinations/marks_register') }}" class="nav-link  @if(Request::segment(3) == 'marks_register') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marks Register</p>
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link  @if(Request::segment(3) == 'marks_grade') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marks Grade</p>
                  </a>
                </li> 
              </ul>
            </li> 
            <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Attendance
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/attendance/student') }}" class="nav-link  @if(Request::segment(3) == 'student') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Student Attendance</p>
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{ url('admin/attendance/report') }}" class="nav-link  @if(Request::segment(3) == 'report') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance Report</p>
                  </a>
                </li>  
              </ul>
            </li> 
            <li class="nav-item @if(Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'communicate') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Communicate
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/communicate/notice_board') }}" class="nav-link  @if(Request::segment(3) == 'notice_board') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Notice Board</p>
                  </a>
                </li>    
                <li class="nav-item">
                  <a href="{{ url('admin/communicate/send_email') }}" class="nav-link  @if(Request::segment(3) == 'send_email') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Send Email</p>
                  </a>
                </li>    
              </ul>
            </li> 
            <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Homework
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/homework/homework') }}" class="nav-link  @if(Request::segment(3) == 'homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Homework</p>
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="{{ url('admin/homework/homework_report') }}" class="nav-link  @if(Request::segment(3) == 'homework_report') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Homework Report</p>
                  </a>
                </li>         
              </ul>
            </li> 
            <li class="nav-item @if(Request::segment(2) == 'material') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'material') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Material
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/material/material') }}" class="nav-link  @if(Request::segment(3) == 'material') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material</p>
                  </a>
                </li>  
              </ul>
            </li> 

            <li class="nav-item">
              <a href="{{ url('admin/account') }}" class="nav-link  @if(Request::segment(2) == 'account') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Account
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin/setting') }}" class="nav-link  @if(Request::segment(2) == 'setting') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Setting
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin/change_password') }}" class="nav-link  @if(Request::segment(2) == 'change_password') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li> 

          @elseif(Auth::user()->user_type == 2)
            <li class="nav-item">
              <a href="{{ url('teacher/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard 
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('teacher/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Student
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Class & Subject 
                </p>
              </a>
            </li> 
            {{-- <li class="nav-item">
              <a href="{{ url('teacher/my_exam_timetable') }}" class="nav-link  @if(Request::segment(2) == 'my_exam_timetable') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Exam Timetable
                </p>
              </a>
            </li>  --}}
            <li class="nav-item">
              <a href="{{ url('teacher/my_calendar') }}" class="nav-link  @if(Request::segment(2) == 'my_calendar') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Calendar
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('teacher/my_jurnal') }}" class="nav-link  @if(Request::segment(2) == 'my_jurnal') active @endif">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  My Jurnal
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('teacher/marks_register') }}" class="nav-link  @if(Request::segment(2) == 'marks_register') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Marks Register
                </p>
              </a>
            </li> 

            <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Attendance
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('teacher/attendance/student') }}" class="nav-link  @if(Request::segment(3) == 'student') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Student Attendance</p>
                  </a>
                </li>  
                <li class="nav-item">
                  <a href="{{ url('teacher/attendance/report') }}" class="nav-link  @if(Request::segment(3) == 'report') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance Report</p>
                  </a>
                </li>  
              </ul>
            </li> 


            <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Homework
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('teacher/homework/homework') }}" class="nav-link  @if(Request::segment(3) == 'homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Homework</p>
                  </a>
                </li>     
              </ul>
            </li> 
            <li class="nav-item @if(Request::segment(2) == 'material') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'material') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Material
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('teacher/material/material') }}" class="nav-link  @if(Request::segment(3) == 'material') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material</p>
                  </a>
                </li>  
              </ul>
            </li> 

            <li class="nav-item">
              <a href="{{ url('teacher/my_projek_akhir') }}" class="nav-link  @if(Request::segment(2) == 'my_projek_akhir') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Projek Akhir
                </p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="{{ url('teacher/my_notice_board') }}" class="nav-link  @if(Request::segment(2) == 'my_notice_board') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Notice Board
                </p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="{{ url('teacher/account') }}" class="nav-link  @if(Request::segment(2) == 'account') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Account
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('teacher/change_password') }}" class="nav-link  @if(Request::segment(2) == 'change_password') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li> 
          @elseif(Auth::user()->user_type == 3)
            <li class="nav-item">
              <a href="{{ url('student/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li> 
            {{-- <li class="nav-item">
              <a href="{{ url('student/fees_collection') }}" class="nav-link  @if(Request::segment(2) == 'fees_collection') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Fees Collection
                </p>
              </a>
            </li>  --}}
            {{-- <li class="nav-item">
              <a href="{{ url('student/my_calendar') }}" class="nav-link  @if(Request::segment(2) == 'my_calendar') active @endif">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  My Calendar
                </p>
              </a>
            </li>  --}}
            {{-- <li class="nav-item">
              <a href="{{ url('student/my_subject') }}" class="nav-link  @if(Request::segment(2) == 'my_subject') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Subject
                </p>
              </a>
            </li>  --}}
            <li class="nav-item">
              <a href="{{ url('student/my_timetable') }}" class="nav-link  @if(Request::segment(2) == 'my_timetable') active @endif">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                  Jadwal
                </p>
              </a>
            </li> 
            {{-- <li class="nav-item">
              <a href="{{ url('student/my_exam_timetable') }}" class="nav-link  @if(Request::segment(2) == 'my_exam_timetable') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Exam Timetable
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('student/my_exam_result') }}" class="nav-link  @if(Request::segment(2) == 'my_exam_result') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Exam Result
                </p>
              </a>
            </li>  --}}
            <li class="nav-item">
              <a href="{{ url('student/my_attendance') }}" class="nav-link  @if(Request::segment(2) == 'my_attendance') active @endif">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Kehadiran
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('student/my_material') }}" class="nav-link  @if(Request::segment(2) == 'my_material') active @endif">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Materi
                </p>
              </a>
            </li> 
            {{-- <li class="nav-item">
              <a href="{{ url('student/my_notice_board') }}" class="nav-link  @if(Request::segment(2) == 'my_notice_board') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Notice Board
                </p>
              </a>
            </li>  --}}
            
            <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Penugasan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('student/homework/my_homework') }}" class="nav-link  @if(Request::segment(3) == 'my_homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tugas</p>
                  </a>
                </li>   
                <li class="nav-item">
                  <a href="{{ url('student/homework/my_submitted_homework') }}" class="nav-link  @if(Request::segment(3) == 'my_submitted_homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengumpulan Tugas</p>
                  </a>
                </li>   
              </ul>
            </li> 

            {{-- <li class="nav-item">
              <a href="{{ url('student/my_homework') }}" class="nav-link  @if(Request::segment(2) == 'my_homework') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Homework
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('student/my_submitted_homework') }}" class="nav-link  @if(Request::segment(2) == 'my_submited_homework') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Submited Homework
                </p>
              </a>
            </li>  --}}

            <li class="nav-item @if(Request::segment(2) == 'setting') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Pengaturan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('student/setting/account') }}" class="nav-link  @if(Request::segment(3) == 'account') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Akun</p>
                  </a>
                </li>   
                <li class="nav-item">
                  <a href="{{ url('student/setting/change_password') }}" class="nav-link  @if(Request::segment(3) == 'change_password') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ubah Password</p>
                  </a>
                </li>   
              </ul>
            </li> 

            {{-- <li class="nav-item">
              <a href="{{ url('student/account') }}" class="nav-link  @if(Request::segment(2) == 'account') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Account
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('student/change_password') }}" class="nav-link  @if(Request::segment(2) == 'change_password') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li>  --}}

          @elseif(Auth::user()->user_type == 4)
            <li class="nav-item">
              <a href="{{ url('parent/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard 
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('parent/my_student') }}" class="nav-link  @if(Request::segment(2) == 'my_student') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Student
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('parent/my_student_notice_board') }}" class="nav-link  @if(Request::segment(2) == 'my_student_notice_board') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Student Notice Board
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('parent/my_notice_board') }}" class="nav-link  @if(Request::segment(2) == 'my_notice_board') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Notice Board
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('parent/account') }}" class="nav-link  @if(Request::segment(2) == 'account') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  My Account
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('parent/change_password') }}" class="nav-link  @if(Request::segment(2) == 'change_password') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li> 
          @endif 
 
          <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Keluar
              </p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
