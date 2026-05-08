<section class="admin-card professional-card" id="quotes">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Content blocks</p>
            <h2>Quotes</h2>
        </div>
        <span class="admin-chip">Editable list</span>
    </div>

    <div class="admin-table-wrap professional-table">
        <table>
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Context</th>
                    <th>Quote</th>
                    <th>Active</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotesList as $quote)
                    <tr>
                        <td><input name="quotes[{{ $quote->id }}][source]" value="{{ old("quotes.$quote->id.source", $quote->source) }}"></td>
                        <td><input name="quotes[{{ $quote->id }}][context]" value="{{ old("quotes.$quote->id.context", $quote->context) }}"></td>
                        <td><textarea name="quotes[{{ $quote->id }}][quote]">{{ old("quotes.$quote->id.quote", $quote->quote) }}</textarea></td>
                        <td>
                            <input type="hidden" name="quotes[{{ $quote->id }}][is_active]" value="0">
                            <label class="switch-mini"><input type="checkbox" name="quotes[{{ $quote->id }}][is_active]" value="1" {{ old("quotes.$quote->id.is_active", $quote->is_active) ? 'checked' : '' }}> Active</label>
                        </td>
                        <td><label class="delete-check"><input type="checkbox" name="quotes[{{ $quote->id }}][delete]" value="1"> Delete</label></td>
                    </tr>
                @endforeach

                <tr class="new-row">
                    <td><input name="new_quote[source]" placeholder="Source"></td>
                    <td><input name="new_quote[context]" placeholder="Context"></td>
                    <td><textarea name="new_quote[quote]" placeholder="New quote"></textarea></td>
                    <td>
                        <input type="hidden" name="new_quote[is_active]" value="0">
                        <label class="switch-mini"><input type="checkbox" name="new_quote[is_active]" value="1" checked> Active</label>
                    </td>
                    <td><span class="muted">New</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
