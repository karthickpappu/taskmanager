<style>
    .card-fullscreen .card-options-fullscreen i:before {
        content: '\f2d1';
    }
    .card-collapsed .card-options-collapse i:before {
        content: '\f078';
    }
    .card-collapsed .card-options-remove i:before {
        content: '\f00d';
    }
    .custom-control {
        user-select: none;
        cursor: pointer;
    }
</style>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="tab-content"><div class="tab-pane active" id="Roles_Permissions">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Roles &amp; Permissions</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-3 tp-setting">
                                <li class="list-group-item">
                                    Anyone seeing my profile page
                                    <div class="float-right">
                                        <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Anyone send me a message
                                    <div class="float-right">
                                        <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Anyone posts a comment on my post
                                    <div class="float-right">
                                        <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Anyone invite me to group
                                    <div class="float-right">
                                        <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked="">
                                        <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                            <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Module Permission</th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Create</th>
                                        <th>Delete</th>
                                        <th>Import</th>
                                        <th>Export</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Holidays</td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leave Request</td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Events</td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked="">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>