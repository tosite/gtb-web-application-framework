<form method="post" action="/tester" id="tester">
    <div class="card">
        <div class="card-content">
            <div class="row">
                {{ csrf_field() }}
                <div class="col s12 m6">
                    <label>Select Method</label>
                    <select
                            class="browser-default"
                            name="action"
                            id="form-action"
                            onchange="setAction();"
                            required
                    >
                        <option value="" disabled selected>Choose Methods</option>
                        <option value="get" @if($method === 'get') selected @endif>get</option>
                        <option value="post" @if($method === 'post') selected @endif>post</option>
                        <option value="put" @if($method === 'put') selected @endif>put/patch</option>
                        <option value="delete" @if($method === 'delete') selected @endif>delete</option>
                    </select>
                </div>
                <div class="col m6"></div>
                <div class="input-field col s12">
                    <input id="uri" name="uri" type="text" class="validate" placeholder="/api/comments" value="{{ $uri }}">
                    <label for="uri">Uri</label>
                </div>
                <div class="col m6"></div>
                <div class="input-field col s12">
                    <input id="params" id="params" type="text" class="validate" value="{{ $params }}">
                    <label for="params">Params</label>
                    <span class="helper-text">Optional.</span>
                </div>
            </div>
        </div>
        <div class="card-action right-align">
            <button
                    type="submit"
                    class="waves-effect waves-red btn-flat pink-text text-lighten-1"
            >submit
            </button>
        </div>
    </div>
</form>
