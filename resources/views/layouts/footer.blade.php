		<script>var KTAppSettings = {  };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('plugins/global/plugins.bundle.js?v=7.0.4')}}"></script>
		<script src="{{asset('js/scripts.bundle.js?v=7.0.4')}}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.4')}}"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{asset('js/pages/widgets.js?v=7.0.4')}}"></script>
        <script>
            $('.customSelect').select2({
                placeholder: "Select a state"
            });
        </script>
