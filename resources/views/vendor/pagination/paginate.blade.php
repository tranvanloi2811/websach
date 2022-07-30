<div class="btn-group">
    <select id="paginationss" class="btn btn-tool" name="pagination">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
    </select>
</div>
<div style="text-align:center; padding:auto">
    {{$paginator->firstItem()}}-{{$paginator->lastItem()}}/{{$paginator->total()}}
</div>

<div class="card-tools">
    <a style="padding:5px" href="{{$paginator->previousPageUrl()}}" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
    <a style="padding:5px" href="{{$paginator->nextPageUrl()}}" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
</div>