<?php


namespace App\Http\Controllers;


use App\Http\ViewModels\BackLog\BackLogIndexViewModel;
use App\Http\ViewModels\BackLog\UserStoryViewModel;
use Illuminate\Http\Request;
use Scrum\Application\Service\BackLog\AddUserStoryCommand;
use Scrum\Application\Service\BackLog\BackLogApplicationService;
use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;

class BackLogController extends Controller
{
    public function index(BackLogQueryServiceInterface $backLogQueryService)
    {
        $userStories = $backLogQueryService->getAllUserStory();

        $userStoriesViewModels = [];
        foreach ($userStories as $userStory){
            $vm = new UserStoryViewModel(
                $userStory->id,
                $userStory->story,
                $userStory->demo,
                $userStory->estimate,
                $userStory->seq
            );
            array_push($userStoriesViewModels, $vm);
        }

        $viewModel = new BackLogIndexViewModel($userStoriesViewModels);

        return view("backlog/index", compact("viewModel"));
    }

    public function getAddUserStory() {
        return view("backlog/add-user-story");
    }

    public function postAddUserStory(Request $request, BackLogApplicationService $applicationService)
    {
        $story = $request->input("story");

        $command = new AddUserStoryCommand($story);
        $applicationService->addUserStory($command);

        return redirect()->action([BackLogController::class, "index"]);
    }
}
