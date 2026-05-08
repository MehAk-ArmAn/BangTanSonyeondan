<section class="admin-card professional-card" id="navigation">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Menu builder</p>
            <h2>Navigation</h2>
        </div>
        <span class="admin-chip">Footer + header links</span>
    </div>

    <div class="admin-table-wrap professional-table">
        <table>
            <thead>
                <tr>
                    <th>Label</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($navList as $item)
                    <tr>
                        <td><input name="nav[{{ $item->id }}][label]" value="{{ old("nav.$item->id.label", $item->label) }}"></td>
                        <td><input name="nav[{{ $item->id }}][url]" value="{{ old("nav.$item->id.url", $item->url) }}"></td>
                        <td><input type="number" name="nav[{{ $item->id }}][sort_order]" value="{{ old("nav.$item->id.sort_order", $item->sort_order) }}"></td>
                        <td>
                            <input type="hidden" name="nav[{{ $item->id }}][is_active]" value="0">
                            <label class="switch-mini"><input type="checkbox" name="nav[{{ $item->id }}][is_active]" value="1" {{ old("nav.$item->id.is_active", $item->is_active) ? 'checked' : '' }}> Active</label>
                        </td>
                        <td><label class="delete-check"><input type="checkbox" name="nav[{{ $item->id }}][delete]" value="1"> Delete</label></td>
                    </tr>
                @endforeach

                <tr class="new-row">
                    <td><input name="new_nav[label]" placeholder="New label"></td>
                    <td><input name="new_nav[url]" placeholder="/songs or /#members"></td>
                    <td><input type="number" name="new_nav[sort_order]" value="0"></td>
                    <td>
                        <input type="hidden" name="new_nav[is_active]" value="0">
                        <label class="switch-mini"><input type="checkbox" name="new_nav[is_active]" value="1" checked> Active</label>
                    </td>
                    <td><span class="muted">New</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
