<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<br>
@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li> ID: {{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="created_at">Создано</label>
                        <input type="text" id="created_at" class="form-control" value="{{ $item->created_at }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Изменено</label>
                        <input type="text" id="updated_at" class="form-control" value="{{ $item->updated_at }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="published_at">Опубликовано</label>
                        <input type="text" name="published_at" id="published_at" class="form-control" value="{{ $item->published_at }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
