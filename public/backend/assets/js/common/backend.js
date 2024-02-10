// Add Books
$('.addBooks').click(function() {
  $('.text-danger').html('');
  $('.ssbook_id').val('');
  $('.validateForm')[0].reset();
  getAuthor();
  $('.modal-title').html('Add Books');
  $('.booksModal').modal({ backdrop: 'static', keyboard: false });
  $('.booksModal').modal('show');
});

// editBooks
$(document).on('click','.editBooks',function(){
  $('.text-danger').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Edit Books');
  let selector = $(this);
  let tr  = selector.closest('tr'); 
  $('.ssbook_id').val(tr.attr('row-book_id'));
  $('.title').val(tr.attr('row-title'));
  $('.description').val(tr.attr('row-description'));
  $('.price').val(tr.attr('row-price'));
  $('.sellCount').val(tr.attr('row-sellCount'));
  getAuthor(tr.attr('row-author_id'));
  $('.booksModal').modal({ backdrop: 'static', keyboard: false });
  $('.booksModal').modal('show');
});

// Add User
$('.addUser').click(function() {
  $('.text-danger').html('');
  $('.user_id').val('');
  $('.validateForm')[0].reset();
  getRoles();
  $('.modal-title').html('Add User');
  $('.userModal').modal({ backdrop: 'static', keyboard: false });
  $('.userModal').modal('show');
});

// editUser
$(document).on('click','.editUser',function(){
  $('.text-danger').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Edit Books');
  let selector = $(this);
  let tr  = selector.closest('tr'); 
  $('.user_id').val(tr.attr('row-user_id'));
  $('.name').val(tr.attr('row-name'));
  $('.email').val(tr.attr('row-email'));
  $('.number').val(tr.attr('row-number'));
  getRoles(tr.attr('row-role_id'));
  $('.userModal').modal({ backdrop: 'static', keyboard: false });
  $('.userModal').modal('show');
});

// Buy books
$(document).on('click','.buyBooks',function(){
  $('.text-danger').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Buy Book');
  let selector = $(this);
  let tr  = selector.closest('tr'); 
  let bookId = tr.attr('row-book_id');
  $('.purchase_book_id').val(bookId);
  $('.purchaseBookModal').modal({ backdrop: 'static', keyboard: false });
  $('.purchaseBookModal').modal('show');
});

function getRoles(role =''){
  $.ajax({
    type: "GET",
    url: ajax + '/admin/get-roles',
    async: true,
    dataType: 'json',
    success: function (response) {
      let rolesData = response.roles;
      let options = '<option value="">Select Role</option>';
      $.each(rolesData, function (index, row) {
        let selected = row.name == role ? 'selected' : '';
        options += '<option value="' + row.id + '" ' + selected + '>' + row.name + '</option>';
      });
      $('.rolesData').html(options);
    }
  });
}


function getAuthor(authorIds = []) {
  $.ajax({
    type: "GET",
    url: ajax + '/admin/get-author',
    async: true,
    dataType: 'json',
    success: function (response) {
      let authors = response.authors;
      let options = '<option value="">Select Author</option>';
      $.each(authors, function (index, row) {
        let selected = authorIds.includes(row.name) ? 'selected' : '';
        options += '<option value="' + row.id + '" ' + selected + '>' + row.name + '</option>';
      });
      $('.authorsData').html(options);
    }
  });
}

//sendAuthorNotification
$(document).on('click','.sendAuthorNotification',function(){
  $('.text-danger').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Send Author Revenue Notification');
  let selector = $(this);
  let tr  = selector.closest('tr'); 
  $('.author_id').val(tr.attr('row-id'));
  $('.author_email').val(tr.attr('row-email'));
  $('.authorModal').modal({ backdrop: 'static', keyboard: false });
  $('.authorModal').modal('show');
});