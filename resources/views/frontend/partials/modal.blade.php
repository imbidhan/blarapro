<!-- Modal -->
<div class="modal fade" id="placeBetBtn" aria-hidden="true" aria-labelledby="placeBetBtn" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div style="display:block;background:#eee" class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-secondary" aria-hidden="true">×</span>
                </button>
                <h4 style="text-align:center" class="modal-title">Place a bet</h4>
            </div>

            <div class="modal-body">
                <div class="modalCustomBody">
                    <p class="text-danger text-center">["error":"Login First."]</p>
                    <p class="text-success text-center">Minimum Bet Amount 20 & Maximum 6000</p>
                    <div class="modalQusAnsBlock">
                        <p  class="text-secondary">Q: To Win The Match</p>
                        <p  class="text-secondary">A: Bangladesh</p>
                        <input type="number" name="betAmount" value="20"/>
                        <span class="text-warning"> Est. Return: 100</span>
                    </div>
                </div>
            </div>

            <div style="display:block;background:#eee" class="modal-footer  text-center">
                <button class="btn btn-md btn-outline-secondary" type="submit" name="placeBet"> Place Bet </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
