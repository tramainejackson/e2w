<div id="navi">
	<ul id="navi_list">
		<li>
			<a href="{{ route('location.index') }}" id="" class="navi_option">Trip Locations</a>
			<ul>
				<li><a href="{{ route('location.create') }}">Add Trips</a></li>
				<li><a href="{{ route('location.index') }}">Edit Trip Events</a></li>
			</ul>
		</li>
		<li>
			<a href="{{ route('pictures.index') }}" id="" class="navi_option">Trip Pictures</a>
			<ul>
				<li><a href="{{ route('pictures.create') }}">Add Pictures</a></li>
				<li><a href="{{ route('pictures.index') }}">Edit Pictures</a></li>
			</ul>
		</li>
		<li>
			<a href="{{ route('participants.index') }}" id="" class="navi_option">Contacts</a>
			<ul>
				<li><a href="{{ route('participants.create') }}">Add A Contact</a></li>
				<li><a href="{{ route('participants.index') }}">Edit Contacts</a></li>
			</ul>
		</li>
		<li>
			<a href="{{ route('admin.index') }}" id="" class="navi_option">Users</a>
			<ul>
				<li><a href="{{ route('admin.create') }}">Add New Admin</a></li>
				<li><a href="{{ route('admin.index') }}">Edit Admin</a></li>
			</ul>
		</li>
		<li>
			<a href="{{ route('questions.index') }}" class="navi_option">Questions</a>
		</li>
		<li>
			<a href="{{ route('suggestions.index') }}" id="" class="navi_option">Suggestions</a>
		</li>
		<li>
			<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
			
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</li>
	</ul>
</div>