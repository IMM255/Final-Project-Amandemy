<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.upvote-button, .downvote-button').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var type = button.data('type');
            var complaintId = button.data('complaint-id');
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/complaints/' + complaintId + '/vote',
                type: 'POST',
                data: {
                    _token: token,
                    type: type
                },
                success: function(response) {
                    if(response.success) {
                        var upvoteButton = $('#vote-form-upvote-' + complaintId).find('button');
                        var downvoteButton = $('#vote-form-downvote-' + complaintId).find('button');

                        // Update counts
                        upvoteButton.html(" <i class='bx " + (response.userVote == 'upvote' ? 'bxs-upvote' : 'bx-upvote') + "'></i> "+response.upvotes + " Mendukung");
                        downvoteButton.html(" <i class='bx " + (response.userVote == 'downvote' ? 'bxs-downvote' : 'bx-downvote') + "'></i> "+response.downvotes +" Menolak");

                        // Disable or enable buttons
                        upvoteButton.prop('disabled', response.userVote == 'upvote');
                        downvoteButton.prop('disabled', response.userVote == 'downvote');
                    }
                }
            });
        });
    });
</script>
