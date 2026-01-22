<!DOCTYPE html>
<html>
<head>
<title>Dine Craft - Manage Stock</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    font-family: Arial;
    background:#f2f2f2;
}

.container{
    width: 95%;
    margin: 20px auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

h2{
    color:orange;
    text-align:center;
}

.alert{
    background:#ffe5e5;
    color:red;
    padding:10px;
    border:1px solid red;
    border-radius:5px;
}

button{
    background:orange;
    color:white;
    border:none;
    padding:6px 12px;
    cursor:pointer;
    border-radius:5px;
}

.delete-btn{
    background:red;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:orange;
    color:white;
    padding:8px;
}

td{
    padding:8px;
    border-bottom:1px solid #ddd;
}

/* MODAL */
.modal{
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
}

.modal-content{
    background:white;
    width:40%;
    margin:10% auto;
    padding:20px;
    border-radius:10px;
}

.close{
    float:right;
    cursor:pointer;
    font-size:20px;
}
</style>
</head>

<body>

<div class="container">

<h2>📦 Dine Craft - Manage Stock</h2>

@if($stocks->where('quantity','<',10)->count() > 0)
<div class="alert">
⚠️ Warning: Some items are running low in stock!
</div>
@endif

<br>

<div class="card">
<form method="GET">
<input name="search" placeholder="Search item..." value="{{ $search }}">
<button>Search</button>
</form>
</div>

<br>

<div class="card">
<h3>Add Stock</h3>
<form method="POST" action="/stock">
@csrf
<input name="item_name" placeholder="Item Name" required>
<input type="number" name="quantity" placeholder="Qty" required>
<select name="unit">
<option>Kg</option>
<option>Liters</option>
<option>Packets</option>
</select>
<input type="date" name="expiry_date" required>
<button>Add Stock</button>
</form>
</div>

<br>

<a href="/stock/export">
<button>📥 Download Excel</button>
</a>

<br><br>

<table>
<tr>
<th>Item</th>
<th>Qty</th>
<th>Unit</th>
<th>Expiry</th>
<th>Status</th>
<th>Action</th>
</tr>

@foreach($stocks as $s)
<tr>
<td>{{ $s->item_name }}</td>
<td>{{ $s->quantity }}</td>
<td>{{ $s->unit }}</td>
<td>{{ $s->expiry_date }}</td>

<td>
@if($s->quantity < 10)
<span style="color:red;font-weight:bold;">Low Stock</span>
@else
Available
@endif
</td>

<td>
<button onclick="openModal('{{ $s->id }}','{{ $s->item_name }}','{{ $s->quantity }}')">
Edit
</button>

<form method="POST" action="/stock/{{ $s->id }}" style="display:inline"
onsubmit="return confirm('Delete this item?')">
@csrf @method('DELETE')
<button class="delete-btn">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>

<br>

<h3>Stock Chart</h3>
<canvas id="chart"></canvas>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
        @foreach($stocks as $s)
        "{{ $s->item_name }}",
        @endforeach
    ],
    datasets: [{
      label: 'Stock Quantity',
      data: [
        @foreach($stocks as $s)
        {{ $s->quantity }},
        @endforeach
      ]
    }]
  }
});
</script>

</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
<div class="modal-content">

<span class="close" onclick="closeModal()">×</span>

<h3>Edit Stock</h3>

<form method="POST" id="editForm">
@csrf
@method('PUT')

<input type="text" name="item_name" id="editItem" required>
<input type="number" name="quantity" id="editQty" required>

<button>Save Changes</button>
</form>

</div>
</div>

<script>
function openModal(id,item,qty){
    document.getElementById('editModal').style.display='block';
    document.getElementById('editItem').value=item;
    document.getElementById('editQty').value=qty;
    document.getElementById('editForm').action = '/stock/' + id;
}

function closeModal(){
    document.getElementById('editModal').style.display='none';
}
</script>

</body>
</html>
