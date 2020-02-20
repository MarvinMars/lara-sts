export default {
    init() {
        this.initSeasonSelector()
        this.initSelect2();
    },
    finalize() {
    },
    initSeasonSelector() {
        if (window.playerId) {
            $(document).on('change', 'select[name="seasonSelector"]', function () {
                let seasonId = $(this).val();

                if (seasonId) {
                    window.location.href = laroute.route('frontend.player.stats', {
                        playerId: window.playerId,
                        seasonId: seasonId,
                    })
                }
            });
        }
    },
    initSelect2() {
        $('[data-init="select2"]').select2();
    },
};
