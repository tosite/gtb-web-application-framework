<form method="post" action="" id="tester">
    <div class="card">
        <div class="card-content pb0">
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
                        <option value="get">get</option>
                        <option value="post">post</option>
                        <option value="put">put/patch</option>
                        <option value="delete">delete</option>
                    </select>
                </div>
                <div class="col m6"></div>
                <div class="input-field col s12">
                    <input id="params" type="text" class="validate">
                    <label for="params">Params</label>
                    <span class="helper-text" data-error="wrong" data-success="right">Optional.</span>
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

<script>
  function setAction() {
    const form = document.getElementById('tester');
    const select = document.getElementById('form-action');
    const action = select.selectedOptions[0].value;
    form.action = `/tester/${action}`;
  }
</script>
