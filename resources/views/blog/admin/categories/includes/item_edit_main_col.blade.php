@php /** @var \App\Models\BlogCategory $item */@endphp
<div class="card">
    <div class="card-body">
        <div class="card-title"></div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div class="tab-pane active" id="maindata" role="tabpanel">
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" name="title" id="title" class="form-control" minlength="3" value="{{  old('title') ? old('title'): $item->title }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Идентификатор</label>
                    <input type="text" name="slug" id="slug" class="form-control" minlength="3" value="{{ old('slug') ?? $item->slug }}" >
                </div>
                <div class="form-group">
                    <label for="parent_id">Родитель</label>
                    <select name="parent_id" id="parent_id" class="form-control" placeholder="Выбрать категорию" required>
                        @foreach($categoryList as $categoryOption)
                            <option value="{{ $categoryOption->id }}" @if($categoryOption->id == $item->parent_id)selected @endif>
                                {{ $categoryOption->id }}. {{ $categoryOption->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" rows="3" class="form-control">
                        {{ old('description', $item->description) }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>