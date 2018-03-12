<?php

namespace UserFrosting\Sprinkle\Site\Controller;

use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\NotFoundException;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Support\Exception\ForbiddenException;
use UserFrosting\Sprinkle\Site\Database\Models\Step;
use UserFrosting\Sprinkle\Core\Facades\Debug;
use Carbon\Carbon;

class PageController extends SimpleController
{
    public function pageSteps($request, $response, $args)
    {
        $currentUserId = $this->ci->currentUser;
        Debug::debug($currentUserId);
        var_dump();
        $allsteps = Step::all();
        $recentSteps2 = Step::getMyRecentStepsEntries($this->ci->currentUser);
        //$carbon = new Carbon();
        //$startWeek = Carbon::parse('Sunday')->addWeeks(-1);
       //$steps = User::where('date', '>=', 2)->get();
        //$recentsteps = Step::where('date', '>=', "now() - interval 7 day")->get();
        //$recentsteps = Step::where('user_id', $currentUserId->id)
        //            ->where('date','<', $carbon )
        //            ->where('date','>=', $startWeek )
        //            ->get();
        //$sql = "SELECT date,steps FROM step_entry where date < now()";
        //$recentsteps = Step::query($sql)->get();
        //Debug::debug($startWeek);
        //Debug::debug($recentsteps);
        return $this->ci->view->render($response, 'pages/steps.html.twig', [
            'steps' => $recentSteps2
        ]);
    }

    public function addSteps($request, $response, $args)
    {
              
            /** @var UserFrosting\Sprinkle\Core\MessageStream $ms */
            $ms = $this->ci->alerts;

            // Load the request schema
            $schema = new RequestSchema('schema://requests/steps/create.yaml');

            /** @var UserFrosting\Sprinkle\Account\Database\Models\User $currentUser */
            $currentUser = $this->ci->currentUser;

            /** @var UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
            $classMapper = $this->ci->classMapper;

            /**\UserFrosting\Sprinkle\Core\Facades\Debug::debug("Schema:", $schema);**/
            $params = $request->getParsedBody();
            // Whitelist and set parameter defaults
            $transformer = new RequestDataTransformer($schema);
            $data = $transformer->transform($params);

            /** @var UserFrosting\Config\Config $config */
            $config = $this->ci->config;
        

            Capsule::transaction( function() use ($classMapper, $data, $ms, $config, $currentUser) {
                // Create the user
                $stepentry = $classMapper->createInstance('step_entry', $data);
    
                // Store new user to database
                $stepentry->save();
    
                // Create activity record
               // $this->ci->userActivityLogger->info("User {$currentUser->user_name} created a new account for {$user->user_name}.", [
                //    'type' => 'account_create',
                //    'user_id' => $currentUser->id
                //]);
    
                // Load default roles
                //$defaultRoleSlugs = $classMapper->staticMethod('role', 'getDefaultSlugs');
                //$defaultRoles = $classMapper->staticMethod('role', 'whereIn', 'slug', $defaultRoleSlugs)->get();
                //$defaultRoleIds = $defaultRoles->pluck('id')->all();
    
                // Attach default roles
                //$user->roles()->attach($defaultRoleIds);
    
                // Try to generate a new password request
                //$passwordRequest = $this->ci->repoPasswordReset->create($user, $config['password_reset.timeouts.create']);
    
                // Create and send welcome email with password set link
                //$message = new TwigMailMessage($this->ci->view, 'mail/password-create.html.twig');
    
                //$message->from($config['address_book.admin'])
                //        ->addEmailRecipient(new EmailRecipient($user->email, $user->full_name))
                //        ->addParams([
                //            'user' => $user,
                //            'create_password_expiration' => $config['password_reset.timeouts.create'] / 3600 . ' hours',
                //            'token' => $passwordRequest->getToken()
                //        ]);
    
                //$this->ci->mailer->send($message);

                $newtotal = Step::getMyRecentStepsTotal($currentUser->id);

                $ms->addMessageTranslated('success', 'STEPS.CREATED', $data);
            });
    
            return $response->withStatus(200);


            //$steppentry = $this->createInstance('step_entry', $data);

            // Store new user to database
            //$step->save();

            //$stepentry = Step::setStepsEntry($id,$steps,$date);

        
        //return $this->ci->view->render($response, 'pages/steps.html.twig');
    }
}