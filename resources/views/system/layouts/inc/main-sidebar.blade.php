@php
    $currentURL = Request::route()->getName();
@endphp
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
         <li class="<?= ($currentURL == 'controller::product::index') ? 'active' : '' ?>">
            <a href="{{route('controller::product::index')}}">
                <i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Sản phẩm</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::category::index') ? 'active' : '' ?>">
            <a href="{{route('controller::category::index')}}">
                <i class="fa fa-list-alt" aria-hidden="true"></i> <span>Danh mục</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::manufacturer::index') ? 'active' : '' ?>">
            <a href="{{route('controller::manufacturer::index')}}">
                <i class="fa fa-industry" aria-hidden="true"></i> <span>Hãng sản xuất</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::blog::index') ? 'active' : '' ?>">
            <a href="{{route('controller::blog::index')}}">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Bài viết</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::email::index') ? 'active' : '' ?>">
            <a href="{{route('controller::email::index')}}">
                <i class="fa fa-envelope" aria-hidden="true"></i> <span>Email đăng ký</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::attribute::index') ? 'active' : '' ?>">
            <a href="{{route('controller::attribute::index')}}">
                <i class="fa fa-filter" aria-hidden="true"></i> <span>Bộ lọc</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::attributeValue::index') ? 'active' : '' ?>">
            <a href="{{route('controller::attributeValue::index')}}">
                <i class="fa fa-outdent" aria-hidden="true"></i> <span>Thuộc tính bộ lọc</span>
            </a>
        </li>
         <li class="<?= ($currentURL == 'controller::inoutput::index') ? 'active' : '' ?>">
            <a href="{{route('controller::inoutput::index')}}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Đơn hàng</span>
            </a>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Cài đặt</span>
            <span class="pull-right-container">
              <i class="fa fa-cogs pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('controller::setting::index')}}"><i class="fa fa-circle-o"></i>Cấu hình</a></li>
            <li><a href="{{route('controller::menu::index')}}"><i class="fa fa-circle-o"></i>Menu</a></li>
            <li><a href="{{route('controller::banner::index')}}"><i class="fa fa-circle-o"></i>Banner</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
