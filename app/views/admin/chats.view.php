
<?php

use Model\Auth;

 $this->view('admin/admin-header', $data) ?>
<style>
    body{margin-top:20px;}

.chat-online {
    color: #34ce57
}

.chat-offline {
    color: #e4606d
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 800px;
    overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}
</style>
<main class="content">
    <div class="container p-0">

		<h1 class="h3 mb-3">Messages</h1>

        <?php if(!empty($rows)){ ?>
		<div class="card">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">

                <?php if(!empty($rows)){
                            foreach($rows as $row){ ?>
					<a href="<?=ROOT.'/users/load-messages/'.$row->user_id?>" class="list-group-item list-group-item-action border-0">
						<!-- <div class="badge bg-success float-right">5</div> -->
                        
						<div class="d-flex align-items-start">
							<img src="<?= get_image($row->instructor_std->image) ?>" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
							<div class="flex-grow-1 ml-3">
                            <?= esc($row->instructor_std->name)?? 'Unknown' ?>
								<div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
							</div>
						</div>
					</a>
                    <?php } }else{
                            echo 'no records found';
                        } ?>

					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
                <?php if(!empty($messages)){ ?>
				<div class="col-12 col-lg-7 col-xl-9">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="<?=get_image($user_now[0]->image)?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong><?=esc($user_now[0]->firstname). ' '. esc($user_now[0]->lastname)?></strong>
								<div class="text-muted small"><em><?=get_date($user_now[0]->date)?></em></div>
							</div>
							
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">

                        <?php 
                        if(!empty($messages)):
                            foreach($messages as $msg): 
                            if($msg->message_from == Auth::getId()){ ?>
							<div class="chat-message-right pb-4">
								<div>
									<img src="<?=get_image(Auth::getImage())?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2"><?=get_date(Auth::getDate())?></div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									<?=esc($msg->message)?>
								</div>
							</div>
                            <?php } else { ?>
							<div class="chat-message-left pb-4">
								<div>
									<img src="<?=get_image($user_now[0]->image)?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2"><?=get_date($msg->date_time)?></div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1"><?=esc($user_now[0]->firstname).' '.esc($user_now[0]->lastname)?></div>
									<?= esc($msg->message)?>
								</div>
							</div>

                            <?php } ?>
                            <?php endforeach ?>
                            <?php endif ?>

						</div>
					</div>

					<form action="<?=ROOT.'/users/post-message'?>" method="POST" class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
							<input type="hidden" name="message_to" class="form-control" value="<?=$user_now[0]->id?>">
							<input type="text" name="message" class="form-control" placeholder="Type your message" value="">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
                    </form>

				</div>
                <?php }else{ ?>
                    <div class="col-12 col-lg-7 col-xl-9">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="<?=get_image('')?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong>Unknown</strong>
								<div class="text-muted small"><em></em></div>
							</div>
							
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">

							<div class="chat-message-right pb-4">
								<div>
									<img src="<?=get_image(Auth::getImage())?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2"><?=get_date(Auth::getDate())?></div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									
								</div>
							</div>
							

						</div>
					</div>

					<form  class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
							<input type="hidden" name="message_to" class="form-control" value="">
							<input type="text" disabled name="message" class="form-control" placeholder="Type your message" value="">
							<button type="button" class="btn btn-primary" disabled>Send</button>
						</div>
                    </form>

				</div>
               <?php  } ?>
			</div>
		</div>
        <?php }else{?>
            <div class="card py-5 ">
                <div class="row g-0 py-5">
                    <div class="col-12 text-center py-5">
                        <h4>No message found...</h4>
                    </div>
                </div>
            </div>
        <?php }?>
	</div>
</main>

<?php $this->view('admin/admin-footer', $data) ?>